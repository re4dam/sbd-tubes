<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\voucher_diskon;
use App\Models\jenis_membership;
use App\Models\Pelanggan;

class PembayaranController extends Controller
{
    public function index($id_booking)
    {
        // Ambil informasi pemesanan, metodepembayaran, dan voucher menggunakan kueri SQL
        $booking = DB::select("SELECT * FROM bookings WHERE id_booking = $id_booking")[0];
        $metodePembayaran = DB::select("SELECT * FROM metode_pembayaran");

        // Ambil diskon voucher jika berlaku
        $voucher_diskon = null;
        if ($booking->id_voucher_diskon) {
            $voucher_diskon = DB::select("SELECT * FROM voucher_diskon WHERE id_voucher_diskon = ?", 
            [$booking->id_voucher_diskon]);
            if (!empty($voucher_diskon)) {
                $voucher_diskon = $voucher_diskon[0];
            }
        }

        // Ambil informasi paket fasilitas jika ada
        $paket_fasilitas = null;
        if ($booking->id_paket_fasilitas) {
            $paket_fasilitas = DB::select("SELECT * FROM paket_fasilitas WHERE id_paket_fasilitas = ?", 
            [$booking->id_paket_fasilitas]);
            if (!empty($paket_fasilitas)) {
                $paket_fasilitas = $paket_fasilitas[0];
                $harga_paket = $paket_fasilitas->harga_paket_fasilitas;
            }
        }

        // Hitung harga_pembayaran
        $durasi = $booking->durasi;
        $harga_pembayaran = $durasi * 50000;

        // Ambil pelanggan berdasarkan pemesanan
        $pelanggan = Pelanggan::find($booking->id_pelanggan);

        // Fetch membership informasi dari pelanggan
        $membership = null;
        if ($pelanggan) {
            $membership = $pelanggan->membership;
        }

        // Kalkulasi diskon jika voucher diskon ada dan tidak "tidak ada"
        if ($voucher_diskon && $voucher_diskon->id_voucher_diskon != 4) {
            $diskon = 30; // diskonnya 30%
            $harga_pembayaran = $harga_pembayaran - ($harga_pembayaran * ($diskon / 100));
        }

        // Check pelanggan apakah punya membership atau tidak ada
        if ($membership && $membership->kode_membership != 'tidak ada') {
            $harga_pembayaran = 0; // Gratisin
            $dp = 0; // Gratisin
        } else {
            // Kalkulasi dp normal
            $dp = $harga_pembayaran / 2;
        }

        // Harga total dapat dari penjumlahan harga paket + harga pembayaran
        $harga_total = $harga_paket + $harga_pembayaran;

        return view('pembayaran', compact('booking', 'metodePembayaran', 'harga_pembayaran', 'dp', 'voucher_diskon', 'paket_fasilitas', 'harga_total', 'membership'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $booking = DB::select("SELECT * FROM bookings WHERE id_booking = " . $request->input('booking_id'))[0];
        $durasi = $booking->durasi;
        $harga_pembayaran = $durasi * 50000;

        // Ambil diskon voucher jika berlaku
        $voucher_diskon = null;
        if ($booking->id_voucher_diskon) {
            $voucher_diskon = DB::select("SELECT * FROM voucher_diskon WHERE id_voucher_diskon = ?", 
            [$booking->id_voucher_diskon]);
            if (!empty($voucher_diskon)) {
                $voucher_diskon = $voucher_diskon[0];
            }
        }

        // Ambil informasi paket fasilitas jika ada
        $paket_fasilitas = null;
        if ($booking->id_paket_fasilitas) {
            $paket_fasilitas = DB::select("SELECT * FROM paket_fasilitas WHERE id_paket_fasilitas = ?", 
            [$booking->id_paket_fasilitas]);
            if (!empty($paket_fasilitas)) {
                $paket_fasilitas = $paket_fasilitas[0];
                $harga_paket = $paket_fasilitas->harga_paket_fasilitas;
            }
        }

        // Fetch pelanggan sesuai dari booking
        $pelanggan = Pelanggan::find($booking->id_pelanggan);

        // Fetch membership informasi dari pelanggan
        $membership = null;
        if ($pelanggan) {
            $membership = $pelanggan->membership;
        }

        // Kalkulasi diskon jika voucher diskon ada dan tidak "tidak ada"
        if ($voucher_diskon && $voucher_diskon->id_voucher_diskon != 4) {
            $diskon = 30; // Assuming a flat 30% discount
            $harga_pembayaran = $harga_pembayaran - ($harga_pembayaran * ($diskon / 100));
        }

        // Check pelanggan apakah punya membership atau tidak ada
        if ($membership && $membership->kode_membership != 'tidak ada') {
            $harga_pembayaran = 0; // Gratisin
            $dp = 0; // Gratisin
        } else {
            // Kalkulasi dp normal
            $dp = $harga_pembayaran / 2;
        }

        // Harga total dapat dari penjumlahan harga paket + harga pembayaran
        $harga_total = $harga_paket + $harga_pembayaran;

        // Masukkan pembayaran baru menggunakan kueri SQL
        DB::statement("INSERT INTO pembayaran (id_booking, id_metode_pembayaran, 
            harga_pembayaran, harga_dp, bukti_pembayaran, harga_total) VALUES (?, ?, ?, ?, ?, ?)", [
            $request->input('booking_id'),
            $request->input('metode_pembayaran'),
            $harga_pembayaran,
            $dp,
            $buktiPembayaran,
            $harga_total
        ]);

        return redirect()->route('pembayaran.index', $request->input('booking_id'))->with('success', 'Pembayaran berhasil.');
    }
}