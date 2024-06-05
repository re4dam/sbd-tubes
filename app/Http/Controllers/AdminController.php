<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminController extends Controller
{
    public function adminpage(){
        $bookings = Booking::all(); // Make sure to fetch all bookings to pass to the view
        return view('admin.admindashboard', compact('bookings'));
    }

    public function approval($id_booking){
        $booking = Booking::find($id_booking);
        if ($booking && $booking->status == 'pending') {
            $booking->status = 'Approved';
            $booking->save();
        }

        return redirect()->route('adminpage')->with('success', 'Sudah Approved!');
    }
}