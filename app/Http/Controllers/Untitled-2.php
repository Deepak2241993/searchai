<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AadhaarController extends Controller
{
    private $apiKey = 'gdFO0OUjcmksU6OLjG8b1aqfuF3r7kU7';

    public function showForm()
    {
        Log::info('Displaying Aadhaar OTP generation form.');
        return view('aadhaar.form');
    }

    public function generateOtp(Request $request)
    {
        dd($request->all());

        Log::info('Attempting to generate OTP.', ['request_data' => $request->except(['aadhaar_number', 'share_code'])]);

        // Validate the input
        $validated = $request->validate([
            'aadhaar_number' => 'required|digits:12',
            'share_code' => 'required|string',
        ]);

        // Log validated data for debugging
        Log::debug('Validated request data.', $validated);

        try {
            // Make the HTTP request to the external API
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-API-Key' => $this->apiKey,
                'X-Auth-Type' => 'API-Key',
            ])->post('https://api.gridlines.io/aadhaar-api/boson/generate-otp', [
                'aadhaar_number' => $validated['aadhaar_number'],
                'consent' => 'Y',
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                $data = $response->json();
                Log::info('OTP generated successfully.', ['response_data' => $data]);
                // Return the data as a JSON response
                return response()->json([
                    'success' => true,
                    'transaction_id' => $data['transaction_id'],
                    'share_code' => $validated['share_code'],
                ]);
            }

            // Log error and provide user feedback in case of failure
            Log::error('Failed to generate OTP.', ['response' => $response->body()]);
            return back()->withErrors('Failed to generate OTP. Please try again.');
        } catch (\Exception $e) {
            // Log exception and provide user feedback for unexpected errors
            Log::critical('Exception occurred while generating OTP.', ['error' => $e->getMessage()]);
            return back()->withErrors('An error occurred. Please try again later.');
        }
    }

    public function showVerifyForm()
    {
        // Retrieve the transaction ID from session
        $transactionId = session('transaction_id');
        Log::info('Displaying OTP verification form.', ['transaction_id' => $transactionId]);

        // Ensure the transaction ID is available, otherwise redirect back to the form
        if (!$transactionId) {
            Log::warning('Transaction ID is missing in session.');
            return redirect()->route('aadhaar.form')->withErrors('Transaction ID is missing.');
        }

        return view('aadhaar.verify', compact('transactionId'));
    }

    public function submitOtp(Request $request)
    {
        // Log the request data excluding sensitive information
        Log::info('Attempting to submit OTP.', ['request_data' => $request->except(['otp', 'share_code'])]);

        // Validate the OTP submission data
        $validated = $request->validate([
            'otp' => 'required|digits:6',
            'share_code' => 'required|string|max:4',
            'transaction_id' => 'required|string',
        ]);

        // Store transaction_id in the session for later use
        session(['transaction_id' => $validated['transaction_id']]);

        // Log validated OTP submission data
        Log::debug('Validated OTP submission data.', $validated);

        try {
            // Make the HTTP request to the external API
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-API-Key' => $this->apiKey,
                'X-Auth-Type' => 'API-Key',
                'X-Transaction-ID' => $validated['transaction_id'],
            ])->post('https://api.gridlines.io/aadhaar-api/boson/submit-otp', [
                'otp' => $validated['otp'],
                'include_xml' => true,
                'share_code' => $validated['share_code'],
            ]);

            // Check if the response is successful
            if ($response->successful()) {
                $data = $response->json();
                Log::info('OTP submitted successfully.', ['response_data' => $data]);

                // Return the success view with the received data
                return redirect()->route('aadhaar.success')->with('data', $data);
            }

            // Log error and return error message if OTP submission fails
            Log::error('Failed to submit OTP.', ['response' => $response->body()]);
            return back()->withErrors('Failed to verify OTP. Please try again.');
        } catch (\Exception $e) {
            // Log exception and provide feedback for unexpected errors
            Log::critical('Exception occurred while submitting OTP.', ['error' => $e->getMessage()]);
            return back()->withErrors('An error occurred. Please try again later.');
        }
    }

    public function success()
    {
        // Retrieve data from session
        $data = session('data');
        Log::info('Displaying success page.', ['response_data' => $data]);

        // Ensure data is available before rendering the success view
        if (!$data) {
            Log::warning('No data available in session for success page.');
            return redirect()->route('aadhaar.form')->withErrors('No data available.');
        }

        return view('aadhaar.success', compact('data'));
    }
}
