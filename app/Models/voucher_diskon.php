<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voucher_diskon extends Model
{
    use HasFactory;
    protected $table = 'voucher_diskon';
    protected $primaryKey = 'id_voucher_diskon';
    protected $fillable = ['kode_voucher','nama_voucher','deskripsi_voucher', 'status_voucher','waktu_berlaku', 'waktu_expired'];
    public function voucher_diskon(){
        return $this->hasMany(Booking::class,'id_booking');
    }
}
