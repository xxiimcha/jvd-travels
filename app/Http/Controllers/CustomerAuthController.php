<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CustomerDetail;

class CustomerAuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('customer.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/'); // redirect to homepage
        }

        return back()->with('error', 'Invalid login credentials.');
    }

    // Show register form
    public function showRegister()
    {
        return view('customer.auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer', // if role-based access
        ]);

        // Create related customer_details
        CustomerDetail::create([
            'user_id' => $user->id,
            'name'    => $request->name,
            'email'   => $request->email,
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->intended('/');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
