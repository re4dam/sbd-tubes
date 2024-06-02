<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
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

        // Buat pelanggan baru
        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_telefon_pelanggan' => $request->no_telefon_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'password_pelanggan' => Hash::make($request->password_pelanggan), // Hash password sebelum disimpan
        ]);
        
        // Buat user terkait (jika diperlukan)
        User::create([
            'name' => $request->nama_pelanggan,
            'email' => $request->email_pelanggan,
            'password' => Hash::make($request->password_pelanggan), // Hash password sebelum disimpan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pelanggan berhasil ditambahkan');
    }
}