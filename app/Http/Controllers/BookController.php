<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class BookController extends Controller
{
    public function booking(){
        return view('booking');
    }

    public function store(Request $request){
        // Validasi input
        // $request->validate([
        //     'tanggal' => 'required|date',
        //     'waktu_masuk' => 'required|time', // Validasi unik email di tabel pelanggan
        //     'durasi' => 'required|integer|max:18',
        // ]);
        $mulai = $request->input('waktu_masuk');

        $mulai = new DateTime($mulai);

        $durasi = new DateInterval('PT'.$request->input('durasi').'H');

        $selesai = clone $mulai;
        $selesai->add($durasi);

        $dp = ($request->durasi * 50000) / 2;

        if(DB::select('')){

        }

        else {
            // Buat pelanggan baru
            Booking::create([
            'id_pelanggan'=> $request->id_pelanggan,
            'tanggal'=> $request->tanggal,
            'waktu_masuk'=> $mulai,
            'durasi'=> $request->durasi,
            'waktu_keluar'=> $selesai,
            'uang_dp'=> $dp
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->intended('dashboard')->with('success', 'Pelanggan berhasil ditambahkan');
    }
}
