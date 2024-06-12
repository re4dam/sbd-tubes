<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginController extends Controller
{
    public function loginPage(){
        return view("login");
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|string',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Gunakan kueri sql untuk autentikasi user pelanggannya dari email
        $user = DB::select('SELECT * FROM users WHERE email = ?', [$email]);

        if ($user && password_verify($password, $user[0]->password)) {
            Auth::loginUsingId($user[0]->id);
            $request->session()->regenerate();

            // Jika autentikasi sah atau berhasil, maka akan redirected sesuai pagenya masing masing
            switch ($user[0]->tipe_user) {
                case 'admin':
                    return redirect('adminpage');
                case 'user':
                    return redirect('dashboard');
                default:
                    return redirect('dashboard');
            }
        }

        // Autentikasi gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
