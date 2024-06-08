<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ['id_booking','id_metode_pembayaran','harga_pembayaran','harga_dp', 'bukti_pembayaran', 'harga_total'];
    public function pembayaran(){
        return $this->hasMany(Booking::class,'id_booking');
    }
}
