<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt(array_merge($credentials, ['is_admin' => true]))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not authorized.']);
    }

    // Admin dashboard
    public function dashboard()
    {
        $countUser = User::count();
        $giftCoupon = GiftCoupon::count();
        return view('admin.dashboard', compact('countUser','giftCoupon'));
    }
    
    // Logout
    public function logout()
    {
        Auth::logout();
        session()->invalidate(); 
        session()->regenerateToken(); 
        return redirect()->route('admin.login');
    }


    public function userList(Request $request)
    {
        $sortOrder = $request->get('sort', 'desc');
        $userResult = User::orderBy('created_at', $sortOrder)->paginate(10);
        return view('admin.user.index', compact('userResult', 'sortOrder'));
    }
    public function userEdit(Request $request, $id)
    {
        $userResult = User::findOrFail($id); 
        return view('admin.user.edit', compact('userResult'));
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:8', 
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); 
        }

        $user->save();

        return redirect()->route('admin.user-list')->with('success', 'User updated successfully.');
    }
    public function userDelete($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_admin) {
            return response()->json(['success' => false, 'message' => 'Admin users cannot be deleted.']);
        }

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }




}

