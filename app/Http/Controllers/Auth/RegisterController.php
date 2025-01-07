<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

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

        auth()->login($user);

        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        // Check if the user is already logged in
        if (Auth::check()) {
            // Redirect to home page if the user is logged in
            return redirect()->route('home');
        }

        // If the user is not logged in, show the login form
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Redirect to home if authentication is successful
            return redirect()->route('home');
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
        return redirect()->route('home');
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
        return view('auth.dashboad');
    }
    public function profile()
    {
        return view('auth.profile');
    }
    public function settings()
    {
        return view('auth.settings');
    }
    public function orders()
    {
        $data = Order::where('user_id', auth()->id())->paginate(5); 
        return view('auth.orders', compact('data'));
    }
    public function show($id)
    {
        $token = Token::find($id);
        if ($token) {
            return response()->json([
                'success' => true,
                'token' => [
                    'id' => $token->id,
                    'tokens_purchased' => $token->tokens_purchased,
                    'status' => $token->status,
                    'created_at' => $token->created_at->format('d-m-Y H:i A'),
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Token not found.',
        ]);
    }

}
