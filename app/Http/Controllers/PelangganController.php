<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function landingPage(){
        return view("index");
    }
    
    public function registerPage(){
        return view("register");
    }

    public function pelangganCreate(Request $request){
        // Validasi input
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telefon_pelanggan' => 'required|string|max:15',
            'email_pelanggan' => 'required|email|unique:pelanggan', // Validasi unik email di tabel pelanggan
            'password_pelanggan' => 'required|string|max:18',
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password_pelanggan);

        // Buat pelanggan baru menggunakan SQL query
        DB::statement("
            INSERT INTO pelanggan (nama_pelanggan, no_telefon_pelanggan, email_pelanggan, password_pelanggan) 
            VALUES ('{$request->nama_pelanggan}', '{$request->no_telefon_pelanggan}', '{$request->email_pelanggan}',
             '{$hashedPassword}')
        ");
        
        // Buat user terkait (jika diperlukan) menggunakan SQL query
        DB::statement("
            INSERT INTO users (name, email, password) 
            VALUES ('{$request->nama_pelanggan}', '{$request->email_pelanggan}', '{$hashedPassword}')
        ");

        // Redirect dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pelanggan berhasil ditambahkan');
    }
}
