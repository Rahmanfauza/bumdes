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
        Schema::create('unit_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->text('deskripsi_usaha')->nullable();
            $table->enum('status_usaha', ['Aktif', 'Tidak Aktif', 'Dalam Pengembangan'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_usahas');
    }
};
