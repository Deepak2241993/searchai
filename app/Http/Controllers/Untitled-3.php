// try {
        //     $response = Http::withHeaders([
        //         'Accept' => 'application/json',
        //         'Content-Type' => 'application/json',
        //         'X-API-Key' => $this->apiKey,
        //         'X-Auth-Type' => 'API-Key',
        //     ])->post('https://api.gridlines.io/aadhaar-api/boson/generate-otp', [
        //         'aadhaar_number' => $validated['aadhaar_number'],
        //         'consent' => 'Y',
        //     ]);

        //     if ($response->successful()) {
        //         $data = $response->json();
        //         Log::info('OTP generated successfully.', ['response_data' => $data]);

        //         return redirect()->route('aadhaar.verify')->with([
        //             'transaction_id' => $data['transaction_id'],
        //             'share_code' => $validated['share_code'],
        //         ]);
        //     }

        //     Log::error('Failed to generate OTP.', ['response' => $response->body()]);
        //     return back()->withErrors('Failed to generate OTP. Please try again.');

        // } catch (\Exception $e) {
        //     Log::critical('Exception occurred while generating OTP.', ['error' => $e->getMessage()]);
        //     return back()->withErrors('An error occurred. Please try again later.');
        // }