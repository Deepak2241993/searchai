<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\AadhaarData;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;




class AadhaarController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GridLineAPIKey');
    }


    public function showForm()
    {
        Log::info('Displaying Aadhaar OTP generation form.');
        return view('aadhaar.form');
    }

    public function generateOtp(Request $request)
    {
        Log::info('Attempting to generate OTP.', ['request_data' => $request->except(['aadhaar_number', 'token'])]);

        $validated = $request->validate([
            'aadhaar_number' => 'required|digits:12',
            // 'share_code' => 'string|max:4',
            'token' => 'required|string',
            'service_type' => 'required|string|in:KYC VERIFICATION',
        ]);

        Log::debug('Validated request data.', $validated);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-API-Key' => $this->apiKey,
                'X-Auth-Type' => 'API-Key',
                ])->post('https://api.gridlines.io/aadhaar-api/boson/generate-otp', [
                'aadhaar_number' => $validated['aadhaar_number'],
                'consent' => 'Y',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('OTP generated successfully.', ['response_data' => $data]);

                return redirect()->route('aadhaar.verify')->with([
                    'transaction_id' => $data['transaction_id'],
                    // 'share_code' => $validated['share_code'],
                    'token_share_code' => $validated['token'],
                    'aadhaar_number' => $validated['aadhaar_number'],
                    'service_type' => $validated['service_type'],
                ]);
            }

            Log::error('Failed to generate OTP.', ['response' => $response->body()]);
            return back()->withErrors('Failed to generate OTP. Please try again.');
        } catch (\Exception $e) {
            Log::critical('Exception occurred while generating OTP.', ['error' => $e->getMessage()]);
            return back()->withErrors('An error occurred. Please try again later.');
        }
    }

    public function showVerifyForm()
    {
        $transactionId = session('transaction_id');
        // $shareCode = session('share_code');
        $tokenShareCode = session('token_share_code');
        $aadhaarNumber = session('aadhaar_number');
        $serviceType = session('service_type');

        Log::info('Displaying OTP verification form.', [
            'transaction_id' => $transactionId,
            // 'share_code' => $shareCode,
            'token_share_code' => $tokenShareCode,
            'aadhaar_number' => $aadhaarNumber,
            'service_type' => $serviceType
        ]);

        if (!$transactionId) {
            Log::warning('Transaction ID is missing in session.');
            return redirect()->route('aadhaar.form')->withErrors('Transaction ID is missing.');
        }
        // Pass the session data to the view
        return view('aadhaar.verify', compact('transactionId', 'tokenShareCode', 'aadhaarNumber', 'serviceType'));
    }

    public function submitOtp(Request $request)
    {
        Log::info('Attempting to submit OTP.', ['request_data' => $request->except(['otp', 'token_share_code'])]);

        $validated = $request->validate([
            'otp' => 'required|digits:6',
            // 'share_code' => 'required|string|max:4',
            'transaction_id' => 'required|string',
            'aadhaar_number' => 'required|digits:12',
            'token_share_code' => 'required|string',
            'service_type' => 'required|string',
        ]);

        $token = Token::where('token', $validated['token_share_code'])->first();

        if (!$token) {
            Log::error('Token not found for the given token_share_code.', ['token_share_code' => $validated['token_share_code']]);
            return back()->withErrors('Invalid token share code. Please try again.');
        }

        session(['transaction_id' => $validated['transaction_id']]);

        Log::debug('Validated OTP submission data.', $validated);

        try {
            // Send the OTP submission request
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-API-Key' => $this->apiKey,
                'X-Auth-Type' => 'API-Key',
                'X-Transaction-ID' => $validated['transaction_id'],
            ])->post('https://api.gridlines.io/aadhaar-api/boson/submit-otp', [
                'otp' => $validated['otp'],
                'include_xml' => true,
                'token_share_code' => $validated['token_share_code'],
            ]);

            if ($response->successful()) {
                $data = $response->json();

                Log::info('OTP submitted successfully.', ['response_data' => $data]);

                $aadhaarData = $data['data']['aadhaar_data'] ?? null;

                if (!$aadhaarData) {
                    Log::error('Missing aadhaar_data in response.', ['response' => $data]);
                    return back()->withErrors('Invalid response from Aadhaar API. Please try again.');
                }
                // Save Aadhaar data in the database
                $createdData= AadhaarData::create([
                    'aadhaar_number' => $validated['aadhaar_number'],
                    'reference_id' => $aadhaarData['reference_id'] ?? null,
                    'id_token' => $token->id,
                    'aadhaar_token' => $validated['transaction_id'],
                    'name' => $aadhaarData['name'] ?? null,
                    'date_of_birth' => $aadhaarData['date_of_birth'] ?? null,
                    'gender' => $aadhaarData['gender'] ?? null,
                    'mobile' => $aadhaarData['mobile'] ?? null,
                    'care_of' => $aadhaarData['care_of'] ?? null,
                    'house' => $aadhaarData['house'] ?? null,
                    'street' => $aadhaarData['street'] ?? null,
                    'district' => $aadhaarData['district'] ?? null,
                    'sub_district' => $aadhaarData['sub_district'] ?? null,
                    'landmark' => $aadhaarData['landmark'] ?? null,
                    'post_office_name' => $aadhaarData['post_office_name'] ?? null,
                    'state' => $aadhaarData['state'] ?? null,
                    'pincode' => $aadhaarData['pincode'] ?? null,
                    'country' => $aadhaarData['country'] ?? 'India',
                    'vtc_name' => $aadhaarData['vtc_name'] ?? null,
                ]);
                // Update token status
                $token->status = 'expired';
                $token->save();

               

                try {
                    // Check if the user is authenticated
                    if (Auth::check()) {
                        $authUserEmail = Auth::user()->email;
                        // SCREENING REPORT
                        $order_id= "OT".$token->order_id;
                        $client_data= Auth::user();
                        // END SCREENING REPORT

                        // Attempt to send the email
                        Mail::to($authUserEmail)->send(new \App\Mail\AadhaarSuccessMail($aadhaarData, $aadhaarData['name'], $token->token, $validated['service_type'],$createdData,$order_id,$client_data));

                        // Log successful email delivery
                        Log::info('Aadhaar success email sent successfully.', [
                            'recipient' => $authUserEmail,
                            'aadhaar_data' => $aadhaarData,
                        ]);
                    } else {
                        // Log a warning if no authenticated user is found
                        Log::warning('No authenticated user found. Cannot send email.');
                    }
                } catch (\Exception $e) {
                    // Log failure with error details
                    Log::error('Failed to send Aadhaar success email.', [
                        'recipient' => $authUserEmail ?? 'unknown',
                        'error' => $e->getMessage(),
                    ]);
                }
                // Redirect to success page
                return redirect()->route('aadhaar.success')->with('data', $data);
            }

            Log::error('Failed to submit OTP.', ['response' => $response->body()]);
            return back()->withErrors('Failed to verify OTP. Please try again.');
        } catch (\Exception $e) {
            Log::critical('Exception occurred while submitting OTP.', ['error' => $e->getMessage()]);
            return back()->withErrors('An error occurred. Please try again later.');
        }
    }


    public function success()
    {
        $data = session('data');
        Log::info('Displaying success page.', ['response_data' => $data]);

        if (!$data) {
            Log::warning('No data available in session for success page.');
            return redirect()->route('aadhaar.form')->withErrors('No data available.');
        }

        return redirect()->route('token.index')->with('success', 'Token purchase was successful!')
        ->with('data', $data);
        
    }
}
