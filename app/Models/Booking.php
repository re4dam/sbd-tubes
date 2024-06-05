<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id_booking';
    protected $fillable = ['id_pelanggan', 'tanggal', 'waktu_masuk','durasi','waktu_keluar','uang_dp'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class,'id_pelanggan');
    }
}
