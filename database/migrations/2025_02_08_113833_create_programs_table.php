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
        Schema::create('programs', function (Blueprint $table) {
            $table->id(); // Kolom ID (primary key)
            $table->string('slug')->unique(); // Kolom slug (unik)
            $table->time('time'); // Kolom waktu
            $table->string('date'); // Kolom tanggal
            $table->string('location'); // Kolom lokasi
            $table->string('maps'); // Kolom lokasi
            $table->string('title'); // Kolom judul
            $table->text('body'); // Kolom isi
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
