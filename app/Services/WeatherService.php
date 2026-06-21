<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://api.openweathermap.org/data/2.5';

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key', '');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    public function getCurrentWeather(string $city): ?array
    {
        if (!$this->isConfigured()) return null;

        $data = $this->curlGet("{$this->baseUrl}/weather", [
            'q' => $this->cleanCityName($city),
            'units' => 'metric',
        ]);

        if (!$data || isset($data['cod']) && $data['cod'] !== 200) return null;

        return [
            'temp' => round($data['main']['temp']),
            'feels_like' => round($data['main']['feels_like']),
            'condition' => $data['weather'][0]['description'],
            'icon' => $data['weather'][0]['icon'],
            'humidity' => $data['main']['humidity'],
            'lat' => $data['coord']['lat'],
            'lon' => $data['coord']['lon'],
        ];
    }

    public function getForecast(string $city): ?array
    {
        if (!$this->isConfigured()) return null;

        $data = $this->curlGet("{$this->baseUrl}/forecast", [
            'q' => $this->cleanCityName($city),
            'units' => 'metric',
        ]);

        if (!$data || !isset($data['list'])) return null;

        $days = [];

        foreach ($data['list'] as $entry) {
            $date = substr($entry['dt_txt'], 0, 10);
            if (!isset($days[$date])) {
                $days[$date] = [
                    'date' => $date,
                    'temp_min' => $entry['main']['temp_min'],
                    'temp_max' => $entry['main']['temp_max'],
                    'condition' => $entry['weather'][0]['description'],
                    'icon' => $entry['weather'][0]['icon'],
                ];
            } else {
                $days[$date]['temp_min'] = min($days[$date]['temp_min'], $entry['main']['temp_min']);
                $days[$date]['temp_max'] = max($days[$date]['temp_max'], $entry['main']['temp_max']);
                $hours = (int) substr($entry['dt_txt'], 11, 2);
                if ($hours >= 11 && $hours <= 14) {
                    $days[$date]['condition'] = $entry['weather'][0]['description'];
                    $days[$date]['icon'] = $entry['weather'][0]['icon'];
                }
            }
        }

        $days = array_slice(array_values($days), 0, 4);

        foreach ($days as &$day) {
            $day['temp_min'] = round($day['temp_min']);
            $day['temp_max'] = round($day['temp_max']);
            $carbon = \Carbon\Carbon::parse($day['date']);
            $day['day_name'] = $carbon->isToday() ? 'Today' : $carbon->format('D');
        }

        return $days;
    }

    public function getAirQuality(float $lat, float $lon): ?array
    {
        if (!$this->isConfigured()) return null;

        $data = $this->curlGet("{$this->baseUrl}/air_pollution", [
            'lat' => $lat,
            'lon' => $lon,
        ]);

        if (!$data || !isset($data['list'][0]['main']['aqi'])) return null;

        $aqi = $data['list'][0]['main']['aqi'];

        $levels = [
            1 => ['label' => 'Good', 'color' => 'text-green-600 bg-green-50 border-green-200'],
            2 => ['label' => 'Fair', 'color' => 'text-yellow-600 bg-yellow-50 border-yellow-200'],
            3 => ['label' => 'Moderate', 'color' => 'text-orange-600 bg-orange-50 border-orange-200'],
            4 => ['label' => 'Poor', 'color' => 'text-red-600 bg-red-50 border-red-200'],
            5 => ['label' => 'Very Poor', 'color' => 'text-purple-600 bg-purple-50 border-purple-200'],
        ];

        return [
            'aqi' => $aqi,
            'level' => $levels[$aqi]['label'] ?? 'Unknown',
            'color' => $levels[$aqi]['color'] ?? 'text-sage-600 bg-sage-50 border-sage-200',
        ];
    }

    public function getCityFromCoordinates(float $lat, float $lon): ?string
    {
        if (!$this->isConfigured()) return null;

        $data = $this->curlGet('https://api.openweathermap.org/geo/1.0/reverse', [
            'lat' => $lat,
            'lon' => $lon,
            'limit' => 1,
        ]);

        if (!$data || !isset($data[0]['name'])) return null;

        $name = $data[0]['name'];
        $localNames = $data[0]['local_names'] ?? [];

        // Prefer Indonesian local name for Indonesian locations
        if (isset($localNames['id'])) {
            $name = $localNames['id'];
        }

        // Strip administrative prefixes to get a clean city name
        $prefixes = [
            'Daerah Khusus Ibukota ', 'DKI ', 'Kabupaten ', 'Kota ', 'Kecamatan ', 'Provinsi ',
            'Special Capital Region of ', 'Special Region of ', 'Capital District of ',
            'City of ', 'District of ', 'Kab ', 'Kec ',
        ];
        $cleaned = trim(str_ireplace($prefixes, '', $name));

        return !empty($cleaned) ? $cleaned : $data[0]['name'];
    }

    public function getAll(string $city): array
    {
        $weather = $this->getCurrentWeather($city);
        $forecast = null;
        $airQuality = null;

        if ($weather) {
            $forecast = $this->getForecast($city);
            $airQuality = $this->getAirQuality($weather['lat'], $weather['lon']);
        }

        return compact('weather', 'forecast', 'airQuality');
    }

    protected function cleanCityName(string $city): string
    {
        // Remove text in parentheses, e.g. "Bekasi (Kabupaten)" -> "Bekasi"
        $cleaned = preg_replace('/\s*\([^)]*\)/', '', $city);

        // Strip administrative prefixes
        $prefixes = [
            'Daerah Khusus Ibukota ', 'DKI ', 'Kabupaten ', 'Kota ', 'Kecamatan ', 'Provinsi ',
            'Special Capital Region of ', 'Special Region of ', 'Capital District of ',
            'City of ', 'District of ', 'Kab ', 'Kec ',
        ];
        $cleaned = trim(str_ireplace($prefixes, '', $cleaned));

        return !empty($cleaned) ? $cleaned : $city;
    }

    protected function curlGet(string $url, array $params): ?array
    {
        try {
            $fullUrl = $url . '?' . http_build_query($params + ['appid' => $this->apiKey]);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $fullUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'EcoLifeHub/1.0');
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $body = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($body === false || $httpCode < 200 || $httpCode >= 300) {
                Log::warning("Weather API failed (HTTP {$httpCode}) for: {$fullUrl}");
                return null;
            }

            $json = json_decode($body, true);
            return $json ?: null;
        } catch (\Exception $e) {
            Log::warning('Weather API failed: ' . $e->getMessage());
            return null;
        }
    }
}
