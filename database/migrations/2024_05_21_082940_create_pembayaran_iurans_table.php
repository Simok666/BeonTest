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
        Schema::create('pembayaran_iurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penghuni_id');
            $table->enum('jenis_iuran', ['kebersihan', '/satpam'])->default('kebersihan');
            $table->date('tanggal_pembayaran');
            $table->text('jumlah_pembayaran');
            $table->timestamps();

            $table->foreign('penghuni_id')->references('id')->on('penghunis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iurans');
    }
};
