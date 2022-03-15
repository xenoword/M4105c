<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TypeUser;
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

            $typeUserList = TypeUser::all();
            if (session('user')->typeUser == $typeUserList[0]) {//user
                return redirect()->intended("ticket");
            }else if (session('user')->typeUser == $typeUserList[1]) {//operateur
                return redirect()->intended("ticketOperateur");
            }else if (session('user')->typeUser == $typeUserList[2]) {//manager
                return redirect()->intended('listOperateur');
            }else if (session('user')->typeUser == $typeUserList[3]) {//admin
                return redirect()->intended('ticket');
            }
        }

        return back()->withErrors([
            "email" => "Email incorrect",
            "password" => "Mot de passe incorrect"
        ]);
    }
    public function disconnect(){
        Auth::logout();
        session(["user"=>null]);
        return redirect("/");
    }
}
