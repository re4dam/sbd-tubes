<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\metodepembayaran;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index($id_booking)
    {
        $booking = Booking::findOrFail($id_booking);
        $metodePembayaran = metodepembayaran::all();
        return view('pembayaran', compact('booking', 'metodePembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        
        $booking = Booking::findOrFail($request->input('booking_id'));
        $durasi = $booking->durasi;
        $harga_pembayaran = $durasi * 50000;

        Pembayaran::create([
            'id_booking' => $request->input('booking_id'),
            'id_metode_pembayaran' => $request->input('metode_pembayaran'),
            'harga_pembayaran' => $harga_pembayaran,
            'harga_dp' => $booking->uang_dp,
            'bukti_pembayaran' => $buktiPembayaran,
        ]);

        return redirect()->route('pembayaran.index', $request->input('booking_id'))->with('success', 'Pembayaran berhasil dilakukan.');
    }
}
