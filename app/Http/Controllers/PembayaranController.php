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
        // Fetch the booking, metodepembayaran, and voucher information using raw SQL queries
        $booking = DB::select("SELECT * FROM bookings WHERE id_booking = $id_booking")[0];
        $metodePembayaran = DB::select("SELECT * FROM metode_pembayaran");

        // Fetch the voucher diskon if applicable
        $voucher_diskon = null;
        if ($booking->id_voucher_diskon) {
            $voucher_diskon = DB::table('voucher_diskon')->where('id_voucher_diskon', $booking->id_voucher_diskon)->first();
        }   

        // Fetch the paket fasilitas information if applicable
        $paket_fasilitas = null;
        if ($booking->id_paket_fasilitas) {
            $paket_fasilitas = DB::table('paket_fasilitas')->where('id_paket_fasilitas', $booking->id_paket_fasilitas)->first();
            $harga_paket = $paket_fasilitas->harga_paket_fasilitas;
        }

        // Calculate harga_pembayaran
        $durasi = $booking->durasi;
        $harga_pembayaran = $durasi * 50000;

        // Fetch pelanggan based on the booking
        $pelanggan = Pelanggan::find($booking->id_pelanggan);

        // Fetch membership information of the pelanggan
        $membership = null;
        if ($pelanggan) {
            $membership = $pelanggan->membership;
        }

        // Calculate discount if voucher diskon is available and not "tidak ada"
        if ($voucher_diskon && $voucher_diskon->id_voucher_diskon != 4) {
            $diskon = 30; // Assuming a flat 30% discount
            $harga_pembayaran = $harga_pembayaran - ($harga_pembayaran * ($diskon / 100));
        }

        // Check if the customer has a membership
        if ($membership && $membership->kode_membership != 'tidak ada') {
            $harga_pembayaran = 0; // Set the price to 0 if membership exists
            $dp = 0; // Set the down payment to 0 as well
        } else {
            // Calculate dp based on discounted harga_pembayaran
            $dp = $harga_pembayaran / 2;
        }

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

        // Fetch the booking using a raw SQL query
        $booking = DB::select("SELECT * FROM bookings WHERE id_booking = " . $request->input('booking_id'))[0];
        $durasi = $booking->durasi;
        $harga_pembayaran = $durasi * 50000;

        // Fetch the voucher diskon if applicable
        $voucher_diskon = null;
        if ($booking->id_voucher_diskon) {
            $voucher_diskon = DB::table('voucher_diskon')->where('id_voucher_diskon', $booking->id_voucher_diskon)->first();
        }

        // Fetch the paket fasilitas information if applicable
        $paket_fasilitas = null;
        if ($booking->id_paket_fasilitas) {
            $paket_fasilitas = DB::table('paket_fasilitas')->where('id_paket_fasilitas', $booking->id_paket_fasilitas)->first();
            $harga_paket = $paket_fasilitas->harga_paket_fasilitas;
        }

        // Fetch pelanggan based on the booking
        $pelanggan = Pelanggan::find($booking->id_pelanggan);

        // Fetch membership information of the pelanggan
        $membership = null;
        if ($pelanggan) {
            $membership = $pelanggan->membership;
        }

        // Calculate discount if voucher diskon is available and not "tidak ada"
        if ($voucher_diskon && $voucher_diskon->id_voucher_diskon != 4) {
            $diskon = 30; // Assuming a flat 30% discount
            $harga_pembayaran = $harga_pembayaran - ($harga_pembayaran * ($diskon / 100));
        }

        // Check if the customer has a membership
        if ($membership && $membership->kode_membership != 'tidak ada') {
            $harga_pembayaran = 0; // Set the price to 0 if membership exists
            $dp = 0; // Set the down payment to 0 as well
        } else {
            // Calculate dp based on discounted harga_pembayaran
            $dp = $harga_pembayaran / 2;
        }

        $harga_total = $harga_paket + $harga_pembayaran;

        // Insert the new pembayaran using a raw SQL query
        DB::statement("INSERT INTO pembayaran (id_booking, id_metode_pembayaran, harga_pembayaran, harga_dp, bukti_pembayaran, harga_total) VALUES (?, ?, ?, ?, ?, ?)", [
            $request->input('booking_id'),
            $request->input('metode_pembayaran'),
            $harga_pembayaran,
            $dp,
            $buktiPembayaran,
            $harga_total
        ]);

        return redirect()->route('pembayaran.index', $request->input('booking_id'))->with('success', 'Pembayaran berhasil dilakukan.');
    }
}