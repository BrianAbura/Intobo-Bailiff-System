<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login_post(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            return redirect('home')->with('status_success', 'Successfully Authenticated');
        }
        else{
            return back()->with('status_error', 'Invalid Email Address or Password');
        }
    }

    // Forgot Password|Send Reset Link
    public function forgot_pwd_post(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status_success' => __($status)])
                    : back()->withErrors(['status_error' => __($status)]);
    }

    // Reset Password
    public function reset_pwd_post(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('welcome')->with(['status_success' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome')->with('status_success', 'Session Terminated');
    }
}
