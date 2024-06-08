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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking')->autoIncrement();
            $table->foreignId('id_pelanggan')->constrained('pelanggan');
            $table->foreignId('id_voucher_diskon')->constrained('voucher_diskon');
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->integer('durasi');
            $table->time('waktu_keluar');
            $table->bigInteger('uang_dp');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
