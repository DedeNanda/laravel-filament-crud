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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_pelapor');
            $table->enum('jurusan', ['IPA', 'IPS', 'AKUTANSI', 'TKJ', 'ANIMASI']);
            $table->string('no_hp');
            $table->date('tanggal_kejadian');
            $table->string('tempat_kejadian');
            $table->string('nama_korban');
            $table->string('nama_pelaku');
            $table->string('deskripsi_kejadian');
            //selanjutnya tambahkan saksi-saksi ini lupa
            $table->string('bukti_photo')->nullable();
            $table->timestamps();

            //email address :  admin@gmail.com
            //password :  12345678
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
