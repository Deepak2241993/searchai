<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Add this line

class AadhaarController extends Controller
{
    public function verifyAadhaar(Request $request)
    {
        // Validate user input
        $request->validate([
            'aadhaar_number' => 'required|regex:/^\d{12}$/', // Ensure Aadhaar number is 12 digits
            'consent' => 'required|string|in:Y,N',
        ]);

        // $apiUrl = 'https://stoplight.io/mocks/gridlines/gridlines-api-docs/133154718/aadhaar-api/verify';
        $apiUrl = 'https://api.gridlines.io/aadhaar-api/verify';
        $apiKey = 'gdFO0OUjcmksU6OLjG8b1aqfuF3r7kU7';

        // Request headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-Key' => $apiKey,
            'X-Auth-Type' => 'API-Key',
        ];

        // Request body
        $data = [
            'aadhaar_number' => $request->input('aadhaar_number'),
            'consent' => $request->input('consent'),
        ];

        try {
            // Send POST request using Laravel's HTTP Client
            $response = Http::withHeaders($headers)->post($apiUrl, $data);

            if ($response->successful()) {
                // Extract data for readability
                $responseData = $response->json();
                $aadhaarData = $responseData['data']['aadhaar_data'] ?? [];

                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['data']['message'] ?? 'Aadhaar verification successful.',
                    'request_id' => $responseData['data']['request_id'] ?? 'N/A',
                    'details' => [
                        'document_type' => $aadhaarData['document_type'] ?? 'N/A',
                        'gender' => $aadhaarData['gender'] ?? 'N/A',
                        'age_band' => $aadhaarData['age_band'] ?? 'N/A',
                        'mobile' => $aadhaarData['mobile'] ?? 'N/A',
                        'state' => $aadhaarData['state'] ?? 'N/A',
                    ],
                    'timestamp' => $responseData['timestamp'] ?? now()->timestamp,
                ]);
            }

            // Handle error response
            $responseData = $response->json();
            return response()->json([
                'status' => 'error',
                'message' => $responseData['data']['message'] ?? 'API error occurred',
                'code' => $responseData['data']['code'] ?? 'Unknown',
            ], $response->status());
        } catch (\Exception $e) {
            // Handle exception
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    public function extractAadhaarData(Request $request)
    {
        dd($request->all());
        $request->validate([
            'aadhaar_number' => 'required|string|min:12|max:12',
            'base64' => 'required|string',
            'share_code' => 'required|string|min:4|max:4',
            'consent' => 'required|string|in:Y,N',
        ]);

        $apiUrl = env('GRIDLINES_API_URL');
        $apiKey = env('GRIDLINES_API_KEY');

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-Key' => $apiKey,
            'X-Auth-Type' => 'API-Key',
        ];

        $data = [
            'aadhaar_number' => $request->input('aadhaar_number'),
            'base64' => $request->input('base64'),
            'share_code' => $request->input('share_code'),
            'consent' => $request->input('consent'),
        ];

        try {
            $response = Http::withHeaders($headers)->post($apiUrl, $data);

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => $response->json()['message'] ?? 'API error occurred',
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
