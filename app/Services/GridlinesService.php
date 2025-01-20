<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Exceptions\GridlinesApiException;

class GridlinesService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.gridlines.api_url');
        $this->apiKey = config('services.gridlines.api_key');
    }

    public function performOCR($base64Data)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-Key' => $this->apiKey,
            'X-Auth-Type' => 'API-Key',
        ])->post($this->apiUrl, [
            'base64_data' => $base64Data,
            'consent' => 'Y',
        ]);

        if (!$response->successful()) {
            // Throw a custom exception if the response is not successful
            throw new GridlinesApiException('API call failed.', $response->json());
        }

        return $response;
    }
}
