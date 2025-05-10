<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

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

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/customer/dashboard');
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
            'email'    => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->intended('/customer/dashboard');
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}
