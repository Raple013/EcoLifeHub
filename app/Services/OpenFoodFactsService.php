<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class OpenFoodFactsService
{
    protected USDAFoodService $usda;

    public function __construct(USDAFoodService $usda)
    {
        $this->usda = $usda;
    }

    public function search(string $query, int $pageSize = 10): array
    {
        $results = $this->searchOpenFoodFacts($query, $pageSize);

        if (!empty($results)) {
            return $results;
        }

        return $this->usda->search($query, $pageSize);
    }

    protected function searchOpenFoodFacts(string $query, int $pageSize): array
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://world.openfoodfacts.org/cgi/search.pl?' . http_build_query([
                'search_terms' => $query,
                'json' => 1,
                'page_size' => $pageSize,
                'fields' => 'product_name,nutriments,serving_size,brands',
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'EcoLifeHub/1.0');
            $body = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($body === false || $httpCode !== 200) {
                return [];
            }

            $json = json_decode($body, true);
            $products = $json['products'] ?? [];

            if (empty($products)) {
                return [];
            }

            $results = [];
            foreach ($products as $p) {
                $n = $p['nutriments'] ?? [];
                $calories = round((float) ($n['energy-kcal_100g'] ?? $n['energy_100g'] ?? 0), 1);
                $protein = round((float) ($n['proteins_100g'] ?? $n['proteins_value'] ?? 0), 1);
                $carbs = round((float) ($n['carbohydrates_100g'] ?? $n['carbohydrates_value'] ?? 0), 1);
                $sugar = round((float) ($n['sugars_100g'] ?? $n['sugars_value'] ?? 0), 1);
                $fat = round((float) ($n['fat_100g'] ?? $n['fat_value'] ?? 0), 1);

                if ($calories == 0 && $protein == 0 && $carbs == 0 && $fat == 0) {
                    continue;
                }

                $results[] = [
                    'food_name' => $p['product_name'] ?? $query,
                    'calories' => $calories,
                    'protein_g' => $protein,
                    'carbs_g' => $carbs,
                    'sugar_g' => $sugar,
                    'fat_g' => $fat,
                    'serving_size' => $p['serving_size'] ?? '100g',
                    'brand' => $p['brands'] ?? null,
                ];
            }

            return $results;
        } catch (\Exception $e) {
            Log::warning('OpenFoodFacts error', ['message' => $e->getMessage()]);
            return [];
        }
    }
}
