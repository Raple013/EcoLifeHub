<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $endpoint;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key', '');
        $this->endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    }

    public function analyzeFoodImage(string $imageBase64): array
    {
        if (!$this->apiKey) {
            return ['success' => false, 'error' => 'API key not configured'];
        }

        $prompt = <<<PROMPT
You are a nutrition expert. Identify this food or drink item and estimate its nutritional values per standard serving size.
Return ONLY valid JSON (no markdown, no code fences) with this structure:
{
  "food_name": "Name of the food in English + Indonesian if relevant",
  "serving_size": "e.g. 1 plate, 1 piece, 250ml",
  "calories": number,
  "protein_g": number,
  "carbs_g": number,
  "sugar_g": number,
  "fat_g": number
}
Be realistic with portion sizes from the image. For Indonesian foods (nasi goreng, sate, gorengan, etc.) use accurate local estimates.
PROMPT;

        try {
            $response = Http::timeout(60)
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['inline_data' => ['mime_type' => 'image/jpeg', 'data' => $imageBase64]],
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                ]);

            return $this->parseResponse($response);
        } catch (\Exception $e) {
            Log::error('Gemini API exception', ['message' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function estimateNutrition(string $foodName): array
    {
        if (!$this->apiKey) {
            return ['success' => false, 'error' => 'API key not configured'];
        }

        $prompt = <<<PROMPT
You are a nutrition expert. Estimate the nutritional values for "{$foodName}" per standard serving size.
Return ONLY valid JSON (no markdown, no code fences) with this structure:
{
  "food_name": "Full name of the food",
  "serving_size": "e.g. 1 plate, 1 piece, 250ml",
  "calories": number,
  "protein_g": number,
  "carbs_g": number,
  "sugar_g": number,
  "fat_g": number
}
Base your estimate on real nutritional data. For Indonesian foods (nasi goreng, sate, gorengan, rendang, etc.) use accurate local estimates.
PROMPT;

        try {
            $response = Http::timeout(30)
                ->post("{$this->endpoint}?key={$this->apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]],
                    ],
                ]);

            return $this->parseResponse($response);
        } catch (\Exception $e) {
            Log::error('Gemini API exception', ['message' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    protected function parseResponse($response): array
    {
        if (!$response->successful()) {
            $errBody = $response->json('error.message', 'Gemini API returned status ' . $response->status());
            Log::warning('Gemini API error', ['status' => $response->status(), 'body' => $response->body()]);
            return ['success' => false, 'error' => $errBody];
        }

        $text = $response->json('candidates.0.content.parts.0.text', '');
        $text = trim(preg_replace('/^```(?:json)?\s*|\s*```$/m', '', $text));
        $decoded = json_decode($text, true);

        if (!$decoded || !isset($decoded['food_name'])) {
            return ['success' => false, 'error' => 'Could not parse Gemini response'];
        }

        return ['success' => true, 'data' => $decoded];
    }
}
