<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('index');
    }

    public function profilePage(){
        $email = auth()->user()->email;

        $pelanggan = DB::select('SELECT * FROM pelanggan WHERE email_pelanggan = ?', [$email]);

        return view('profile', [
            'pelanggan' => $pelanggan
        ]);
    }

    public function infoAdmin(){
        // Fetch data menggunakan DB select
        $penjuals = DB::select('SELECT * FROM penjual');

        return view('infoadmin', ['penjuals' => $penjuals]);
    }
}