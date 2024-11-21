<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Asegúrate de que esta sea la vista correcta.
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return redirect()->intended('/')
                ->with('success', "Bienvenido de nuevo, {$user->name}!");
        }

        return redirect()->back()->with('error', 'Las credenciales son incorrectas')->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
    }

}
