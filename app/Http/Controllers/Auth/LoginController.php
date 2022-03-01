<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

class LoginController extends Controller
{
    public function displayLogin(Request $request)
    {
        return Inertia::render('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => [
                "required",
                "email"
            ],
            "password" => [
                "required"

            ]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('email', $request->input("email"))->first();
            session(["user"=>$user]);

            return redirect()->intended('ticket');
        }

        return back()->withErrors([
            "email" => "Email incorrect",
            "password" => "Mot de passe incorrect"
        ]);
    }
}
