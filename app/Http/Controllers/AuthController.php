<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function dologin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard.index'));
        }

        return back()->withErrors([
            'email' => 'Identifiant incorrecte.'
        ])->onlyInput('email');

    }

    public function logout()
    {
        Auth::logout();

        return to_route('login')->with('toast_success', 'Vous êtes maintenant déconnecté');
    }
}
