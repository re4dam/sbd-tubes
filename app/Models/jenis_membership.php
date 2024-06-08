<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Http\Models\Pelanggan;

class jenis_membership extends Model
{
    use HasFactory;
    protected $table = 'jenis_membership';
    protected $primaryKey = 'id_membership';
    protected $fillable = ['kode_membership','maks_waktu_main','jumlah_pertemuan'];
    public function jenis_membership(){
        return $this->hasMany(Pelanggan::class,'id_pelanggan');
    }
}
