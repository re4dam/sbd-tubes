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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran')->autoIncrement();
            $table->foreignId('id_booking')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('id_metode_pembayaran')->constrained('metode_pembayaran')->onDelete('cascade');
            $table->bigInteger('harga_pembayaran');
            $table->bigInteger('harga_dp');
            $table->string('bukti_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
