<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class USDAFoodService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.usda.api_key', 'DEMO_KEY');
    }

    public function search(string $query, int $pageSize = 10): array
    {
        try {
            $response = Http::timeout(10)
                ->get('https://api.nal.usda.gov/fdc/v1/foods/search', [
                    'api_key' => $this->apiKey,
                    'query' => $query,
                    'pageSize' => $pageSize,
                    'dataType' => ['Foundation', 'SR Legacy', 'Branded'],
                ]);

            if (!$response->successful()) {
                return [];
            }

            $foods = $response->json('foods', []);
            $results = [];

            foreach ($foods as $food) {
                $nutrients = $this->extractNutrients($food['foodNutrients'] ?? []);

                $results[] = [
                    'fdc_id' => $food['fdcId'],
                    'food_name' => $food['description'],
                    'brand' => $food['brandName'] ?? $food['brandOwner'] ?? null,
                    'calories' => $nutrients['calories'],
                    'protein_g' => $nutrients['protein'],
                    'carbs_g' => $nutrients['carbs'],
                    'sugar_g' => $nutrients['sugar'],
                    'fat_g' => $nutrients['fat'],
                    'serving_size' => $food['servingSize'] ? ($food['servingSize'] . ' ' . ($food['servingSizeUnit'] ?? 'g')) : '100g',
                ];
            }

            return $results;
        } catch (\Exception $e) {
            Log::warning('USDA API error', ['message' => $e->getMessage()]);
            return [];
        }
    }

    protected function extractNutrients(array $nutrients): array
    {
        $map = [
            'calories' => ['Energy', 'Calories', 'Energi'],
            'protein' => ['Protein'],
            'carbs' => ['Carbohydrate, by difference', 'Carbohydrates', 'Karbohidrat'],
            'sugar' => ['Sugars, total including NLEA', 'Sugars, total', 'Sugar', 'Gula'],
            'fat' => ['Total lipid (fat)', 'Fat', 'Lemak'],
        ];

        $result = ['calories' => 0, 'protein' => 0, 'carbs' => 0, 'sugar' => 0, 'fat' => 0];

        foreach ($nutrients as $n) {
            $name = $n['nutrientName'] ?? $n['name'] ?? '';
            $value = $n['value'] ?? 0;

            foreach ($map as $key => $keywords) {
                foreach ($keywords as $kw) {
                    if (stripos($name, $kw) !== false) {
                        $result[$key] = round((float) $value, 1);
                        break 2;
                    }
                }
            }
        }

        return $result;
    }
}
