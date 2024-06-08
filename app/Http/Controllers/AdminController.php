<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminpage(){
        
        $bookings = DB::select("
        SELECT b.*, p.*
        FROM bookings b
        INNER JOIN pembayaran p ON b.id_booking = p.id_booking");
        return view('admin.admindashboard', compact('bookings'));
    }

    public function approval($id_booking){
        
        $booking = DB::select("SELECT * FROM bookings WHERE id_booking = $id_booking");

        if ($booking && $booking[0]->status == 'pending') {
            
            DB::update("UPDATE bookings SET status = 'Approved' WHERE id_booking = $id_booking");
        }

        return redirect()->route('adminpage')->with('success', 'Sudah Approved!');
    }
}
