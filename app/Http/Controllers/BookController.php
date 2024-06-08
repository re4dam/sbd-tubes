<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\voucher_diskon;
use App\Models\paket_fasilitas;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function booking(){
        $vouchers = voucher_diskon::all();
        $paketFasilitas = paket_fasilitas::all();

        
        return view('booking', compact('vouchers', 'paketFasilitas'));
    }

    public function store(Request $request){
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required',
            'durasi' => 'required|integer|max:18',
            'id_voucher_diskon' => 'nullable|exists:voucher_diskon,id_voucher_diskon',
            'id_paket_fasilitas' => 'nullable|exists:paket_fasilitas,id_paket_fasilitas',
        ]);

        $mulai = new DateTime($request->input('waktu_masuk'));
        $durasi = new DateInterval('PT'.$request->input('durasi').'H');
        $selesai = clone $mulai;
        $selesai->add($durasi);

        // Initial calculation of harga_pembayaran
        $harga_pembayaran = $request->durasi * 50000;

        // Check and apply discount if applicable
        if ($request->id_voucher_diskon) {
            $voucher_diskon = DB::table('voucher_diskon')->where('id_voucher_diskon', $request->id_voucher_diskon)->first();
            if ($voucher_diskon && $voucher_diskon->id_voucher_diskon != 4) {
                $diskon = 30; // Assuming a flat 30% discount
                $harga_pembayaran = $harga_pembayaran - ($harga_pembayaran * ($diskon / 100));
            }
        }

        // Calculate dp based on discounted harga_pembayaran
        $dp = $harga_pembayaran / 2;

        // Convert DateTime objects to strings for SQL queries
        $mulaiString = $mulai->format('Y-m-d H:i:s');
        $selesaiString = $selesai->format('Y-m-d H:i:s');
        $tanggal = $request->input('tanggal');
        $id_pelanggan = $request->input('id_pelanggan');
        $id_voucher_diskon = $request->input('id_voucher_diskon');
        $id_paket_fasilitas = $request->input('id_paket_fasilitas');
        $duration = $request->input('durasi');
        
        // Periksa apakah ada booking yang bertabrakan
        $existingBookings = DB::select("
            SELECT * FROM bookings 
            WHERE tanggal = '$tanggal'
            AND (
                (waktu_masuk BETWEEN '$mulaiString' AND '$selesaiString')
                OR (waktu_keluar BETWEEN '$mulaiString' AND '$selesaiString')
                OR (waktu_masuk < '$mulaiString' AND waktu_keluar > '$selesaiString')
            )
        ");

        if (count($existingBookings) > 0) {
            return redirect()->back()->withErrors(['error' => 'Waktu yang dipilih sudah dibooking oleh orang lain.']);
        }

        // Insert the new booking using raw SQL query
        DB::statement("
            INSERT INTO bookings (id_pelanggan, id_voucher_diskon, id_paket_fasilitas, tanggal, waktu_masuk, durasi, waktu_keluar, uang_dp)
            VALUES ('$id_pelanggan', '$id_voucher_diskon', '$id_paket_fasilitas', '$tanggal', '$mulaiString', '$duration', '$selesaiString', '$dp')
        ");

        // Retrieve the ID of the newly created booking
        $newBooking = DB::select("SELECT id_booking FROM bookings WHERE id_pelanggan = '$id_pelanggan' AND tanggal = '$tanggal' AND waktu_masuk = '$mulaiString' LIMIT 1");
        $id_booking = $newBooking[0]->id_booking;

        // Redirect dengan booking ID
        return redirect()->route('pembayaran.index', ['id_booking' => $id_booking])->with('success', 'Booking berhasil ditambahkan');
    }

    public function cart()
    {
        // Get the id pelanggan of the currently authenticated user
        $id_pelanggan = Auth::id();

        // Fetch bookings for the current user with total payment using raw SQL query
        $bookings = DB::select("
            SELECT b.*, p.*
            FROM bookings b
            INNER JOIN pembayaran p ON b.id_booking = p.id_booking
            WHERE b.id_pelanggan = ?
        ", [$id_pelanggan]);

        return view('user_booking', compact('bookings'));
    }

    public function delete($id) {
        // Hapus booking berdasarkan ID yang diberikan
        DB::table('bookings')->where('id_booking', $id)->delete();
    
        // Redirect kembali ke halaman user_booking dengan pesan sukses
        return redirect()->route('cart')->with('success', 'Booking berhasil dihapus');
    }
}
