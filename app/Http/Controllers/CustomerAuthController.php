<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\CustomerDetail;
use App\Mail\SendOtpCode;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        return view('customer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Generate OTP and send
            $otp = rand(100000, 999999);
            session([
                'otp_required' => true,
                'otp_email' => $user->email,
                'otp_code' => $otp,
            ]);

            Mail::to($user->email)->send(new SendOtpCode($otp));
            Auth::logout(); // logout until OTP is verified

            return redirect()->back()->with('otp_required', true);
        }

        return redirect()->back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if ($request->otp == session('otp_code')) {
            $user = User::where('email', session('otp_email'))->first();

            if ($user) {
                Auth::login($user);
                session()->forget(['otp_code', 'otp_required', 'otp_email']);
                return redirect()->intended('/');
            }
        }

        return redirect()->back()->withErrors(['error' => 'Invalid OTP.']);
    }

    public function showRegister()
    {
        return view('customer.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        CustomerDetail::create([
            'user_id' => $user->id,
            'name'    => $request->name,
            'email'   => $request->email,
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
