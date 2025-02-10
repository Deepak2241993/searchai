<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Models\Token;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\TokenPurchaseEmail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'buyTokens' => 'required|string|max:255',
            'service_names' => 'required|array', 
            'service_names.*' => 'required|string|max:255',
            'tokens' => 'required|array',
            'tokens.*' => 'required|numeric|min:1',
        ]);

        // dd($request->all());

        $user = User::find(auth()->id());

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // $user->update([
        //     'name' => $validated['name'],
        //     'email' => $validated['email'],
        // ]);

        $user->customerAddress()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'company_name' => $request->company_name,
                'gst_number' => $request->gst_number
            ]
        );

        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $amountInPaise = $validated['amount'] * 100;

            $orderData = [
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'receipt' => 'order_rcptid_' . uniqid(),
                'payment_capture' => 1,
            ];

            $razorpayOrder = $api->order->create($orderData);
            $tokensToBuy = $validated['buyTokens'];

            // Convert arrays to comma-separated strings
            $service_namesString = implode(',', $validated['service_names']);
            $tokensString = implode(',', $validated['tokens']);

            $order = Order::create([
                'user_id' => $user->id,
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $validated['amount'],
                'currency' => 'INR',
                'status' => 'pending',
                'tokens_purchased' => $tokensToBuy,
                'service_names' => $service_namesString, // Save as comma-separated string
                'tokens' => $tokensString, // Save as comma-separated string
            ]);

            Log::info("Razorpay order created successfully", [
                'order_id' => $razorpayOrder['id'],
                'amount' => $amountInPaise,
                'tokens_purchased' => $tokensToBuy,
                'service_names' => $service_namesString, // Log the string version
                'currency' => 'INR',
            ]);

            return response()->json([
                'orderId' => $razorpayOrder['id'],
                'amount' => $validated['amount'],
            ], 201);
        } catch (\Exception $e) {
            Log::error("Error creating Razorpay order", [
                'error_message' => $e->getMessage(),
                'user_id' => $user->id,
            ]);

            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }


    public function initiatePayment($orderId)
    {
        $order = Order::findOrFail($orderId);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'amount' => $order->amount * 100,
            'currency' => 'INR',
            'receipt' => 'order_rcptid_' . $order->id,
        ]);

        $order->razorpay_order_id = $razorpayOrder->id;
        $order->save();

        return view('payment', ['order' => $razorpayOrder]);
    }

    public function paymentCallback(Request $request)
    {
        // dd($request->all());
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $razorpayPaymentId = $request->razorpay_payment_id;
        $razorpayOrderId = $request->razorpay_order_id;
        $razorpaySignature = $request->razorpay_signature;

        if ($this->verifySignature($razorpayPaymentId, $razorpayOrderId, $razorpaySignature)) {
            $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();

            // dd($order);

            if (!$order) {
                Log::error('Order not found', ['razorpay_order_id' => $razorpayOrderId]);
                return response()->json(['error' => 'Order not found'], 404);
            }

            try {
                $payment = $api->payment->fetch($razorpayPaymentId);

                if ($payment->status === 'captured') {
                    $paymentRecord = new Payment();
                    $paymentRecord->order_id = $order->id;
                    $paymentRecord->razorpay_payment_id = $razorpayPaymentId;
                    $paymentRecord->razorpay_order_id = $razorpayOrderId;
                    $paymentRecord->status = 'success';
                    $paymentRecord->amount = $order->amount;
                    $paymentRecord->currency = $order->currency;
                    $paymentRecord->save();

                    $numberOfTokens = $order->tokens_purchased;
                    // dd($numberOfTokens); 
                    $user = User::find($order->user_id);
                    $expiresAt = Carbon::now()->addDays(600);

                    $tokens = [];
                    $services = explode(',', $order->service_names);
                    $tokensCount = explode(',', $order->tokens);

                    foreach ($services as $index => $service) {
                        $numberOfTokensForService = (int) $tokensCount[$index];  
                    
                        for ($i = 0; $i < $numberOfTokensForService; $i++) {
                            $newToken = new Token();
                            $newToken->user_id = $user->id;
                            $newToken->service_type = $service; 
                            $newToken->token = Str::random(32); 
                            $newToken->expires_at = $expiresAt;
                            $newToken->status = 'active';
                            $newToken->order_id = $order->id;
                            $newToken->save();
                    
                            $tokens[] = $newToken;
                        }
                    }

                    // for ($i = 0; $i < $numberOfTokens; $i++) {
                    //     $newToken = new Token();
                    //     $newToken->user_id = $user->id;
                    //     $newToken->service_type = $services[$i] ?? null;
                    //     $newToken->token = Str::random(32);
                    //     $newToken->expires_at = $expiresAt;
                    //     $newToken->status = 'active';
                    //     $newToken->order_id = $order->id;
                    //     $newToken->save();
                    
                    //     // Push the saved token to the array
                    //     $tokens[] = $newToken;
                    // }
                    

                    // Send the email with the PDF attachment and log success/failure
                    try {
                        Mail::to($user->email)->send(new TokenPurchaseEmail($user, $tokens,$order));
                        Log::info('Token purchase email sent successfully', ['user_email' => $user->email]);
                    } catch (\Exception $e) {
                        Log::error('Failed to send token purchase email', [
                            'error_message' => $e->getMessage(),
                            'user_email' => $user->email,
                        ]);
                    }
                    $order->status = 'paid';
                    $order->save();

                    return response()->json(['success' => true, 'message' => 'Payment successful']);
                } else {
                    Log::error('Payment failed', ['razorpay_payment_id' => $razorpayPaymentId]);
                    return response()->json(['error' => 'Payment failed'], 400);
                }
            } catch (\Exception $e) {
                Log::error('Error verifying payment', [
                    'error_message' => $e->getMessage(),
                    'razorpay_payment_id' => $razorpayPaymentId,
                    'razorpay_order_id' => $razorpayOrderId,
                ]);

                return response()->json(['error' => 'Payment verification failed'], 500);
            }
        } else {
            Log::error('Signature verification failed', [
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_signature' => $razorpaySignature
            ]);
            return response()->json(['error' => 'Payment verification failed'], 400);
        }
    }

    private function verifySignature($razorpayPaymentId, $razorpayOrderId, $razorpaySignature)
    {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $attributes = [
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            return true; // Signature is valid
        } catch (\Exception $e) {
            Log::error('Payment signature verification failed', [
                'error_message' => $e->getMessage(),
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId
            ]);
            return false; // Signature is invalid
        }
    }
    public function success()
    {
        session()->pull('cart');
        return view('payment.success');
    }
    public function failure()
    {
        return view('payment.failure');
    }
}
