<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jenis_membership;
use App\Models\Booking;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['nama_pelanggan','no_telefon_pelanggan','email_pelanggan','password_pelanggan', 'id_membership'];
    
    public function booking(){

        return $this->hasMany(Booking::class,'id_pelanggan');
    }

    public function membership()
    {
        return $this->hasOne(jenis_membership::class, 'id_membership');
    }
}
