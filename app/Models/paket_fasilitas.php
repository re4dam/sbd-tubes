<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket_fasilitas extends Model
{
    use HasFactory;
    protected $table = 'paket_fasilitas';
    protected $primaryKey = 'id_paket_fasilitas';
    protected $fillable = ['kode_fasilitas','nama_paket_fasilitas','deskripsi_paket_fasilitas','harga_paket_fasilitas'];
    public function paket_fasilitas(){
        return $this->hasMany(Booking::class,'id_booking');
    }
}
