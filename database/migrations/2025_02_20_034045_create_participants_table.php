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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('program_title'); // Ganti dari program_slug ke program_title
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nip')->nullable();
            $table->string('dinas');
            $table->string('jabatan');
            $table->string('pemda');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('certificate')->nullable();
            $table->string('material')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
