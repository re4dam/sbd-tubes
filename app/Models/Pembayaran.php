<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = ['id_booking','id_metode_pembayaran','harga_pembayaran','harga_dp', 'bukti_pembayaran'];
    public function pembayaran(){
        return $this->hasMany(Booking::class,'id_booking');
    }
}
