<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voucher_diskon', function (Blueprint $table) {
            $table->id('id_voucher_diskon')->autoIncrement();
            $table->string('kode_voucher');
            $table->string('nama_voucher');
            $table->string('deskripsi_voucher');
            $table->string('status_voucher');
            $table->date('waktu_berlaku');
            $table->date('waktu_expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_diskon');
    }
};
