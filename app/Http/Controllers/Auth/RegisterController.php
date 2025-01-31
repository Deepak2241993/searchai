<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);

        try {
            $password = $request->password;
            Mail::to($user->email)->send(new RegistrationEmail($user, $password));

            // Log email sent success
            Log::info('Registration email sent successfully to ' . $user->email);
        } catch (\Exception $e) {
            // Log email sending failure
            Log::error('Failed to send registration email to ' . $user->email . '. Error: ' . $e->getMessage());
        }

        auth()->login($user);

        if (session()->has('cart')) {
            return redirect()->route('cart.index');
        } else {
            return redirect()->route('home');
        }
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::check()) {
            if (session()->has('cart')) {
                Session::put('cart_data', session()->get('cart'));
            }
        }
        if (Auth::attempt($credentials)) {
            if (Session::has('cart_data')) {
                session()->put('cart', Session::get('cart_data'));
                Session::forget('cart_data');

                return redirect()->route('cart.index');
            } else {
                return redirect()->route('home');
            }
        }

        $errorMessages = [];
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $errorMessages['email'] = 'Incorrect email';
        }
        if ($user && !Auth::attempt($credentials)) {
            $errorMessages['password'] = 'Incorrect Password';
        }

        return back()->withErrors($errorMessages)->withInput();
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    // Handling Forgot Password

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Reset Password 

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function dashboard()
    {
        $user = auth()->user();
        $orderCount = Order::where('user_id', $user->id)->count();
        $tokenCount = Token::where('user_id', $user->id)->count();

        return view('auth.dashboad', compact('orderCount', 'tokenCount'));
    }

    public function profile()
    {
        $user = User::with('customerAddress')->find(Auth::id());
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        return view('auth.profile', ['user' => $user]);
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'alternate_address' => 'nullable|string|max:255',

        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $destinationPath = public_path('uploads/profile_pics');
            $customerAddress = $user->customerAddress;
            if ($customerAddress && $customerAddress->profile_pic && file_exists($destinationPath . '/' . $customerAddress->profile_pic)) {
                unlink($destinationPath . '/' . $customerAddress->profile_pic);
            }
            $profilePicName = time() . '_' . $request->file('profile_pic')->getClientOriginalName();
            $request->file('profile_pic')->move($destinationPath, $profilePicName);
            if ($customerAddress) {
                $customerAddress->profile_pic = $profilePicName;
                $customerAddress->save();
            }
        }
        $user->update($request->only('name', 'email'));
        $customerAddressData = $request->only('phone', 'address', 'profile_pic', 'alternate_address');
        if ($user->customerAddress) {
            $user->customerAddress->update($customerAddressData);
        } else {
            $user->customerAddress()->create($customerAddressData);
        }
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }


    public function settings()
    {
        return view('auth.settings');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function orders()
    {
        // Fetch the orders with related tokens
        $data = Order::with('tokens')
            ->where('user_id', auth()->id())
            ->paginate(5);
        foreach ($data as $order) {
            $tokens = explode(',', $order->tokens);
            $order->tokens_sum = array_sum(array_map('intval', $tokens)); // Sum the tokens
        }
        return view('auth.orders', compact('data'));
    }



    public function show($orderId)
    {
        // dd($orderId);
        $tokens = Token::where('order_id', $orderId)->get();
        // dd($tokens);
        if ($tokens->isNotEmpty()) {
            $tokens = $tokens->map(function ($token) {
                return [
                    'id' => $token->id,
                    'service_type' => $token->service_type,
                    'token' => $token->token,
                    'status' => $token->status,
                    'created_at' => $token->created_at ? $token->created_at->format('Y-m-d') : 'N/A',
                ];
            });

            return response()->json([
                'success' => true,
                'tokens' => $tokens,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No tokens found for this order ID.',
        ]);
    }
}
