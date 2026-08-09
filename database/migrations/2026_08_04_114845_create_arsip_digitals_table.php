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
        Schema::create('arsip_digitals', function (Blueprint $table) {
                        $table->id('id_arsip');
            $table->unsignedBigInteger('id_surat')->nullable();
            $table->string('nama_file');
            $table->string('kategori')->nullable();
            $table->dateTime('upload_date');
            $table->timestamps();
            
            $table->foreign('id_surat')->references('id_surat')->on('surats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_digitals');
    }
};
