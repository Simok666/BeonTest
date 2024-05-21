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
        Schema::create('penghuni_rumahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penghuni_id');
            $table->unsignedBigInteger('rumah_id');
            $table->date('tanggal_mulai_menempati');
            $table->date('tanggal_selesai_menempati');
            $table->timestamps();

            $table->foreign('penghuni_id')->references('id')->on('penghunis')->onDelete('cascade');
            $table->foreign('rumah_id')->references('id')->on('rumahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni_rumahs');
    }
};
