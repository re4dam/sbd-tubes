<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    use HasFactory;
    protected $table = 'Penjual';
    protected $primaryKey = 'id_penjual';
    protected $fillable = ['nama_penjual','alamat_penjual','no_telefon_penjual','email_penjual'];
}
