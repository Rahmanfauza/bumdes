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
        Schema::table('transaksi_penjualans', function (Blueprint $table) {
            // Make id_user nullable for customer self-checkout orders
            $table->unsignedBigInteger('id_user')->nullable()->change();

            if (!Schema::hasColumn('transaksi_penjualans', 'alamat_pengiriman')) {
                $table->text('alamat_pengiriman')->nullable()->after('metode_bayar');
            }

            if (!Schema::hasColumn('transaksi_penjualans', 'catatan')) {
                $table->text('catatan')->nullable()->after('alamat_pengiriman');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_penjualans', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_penjualans', 'alamat_pengiriman')) {
                $table->dropColumn('alamat_pengiriman');
            }
            if (Schema::hasColumn('transaksi_penjualans', 'catatan')) {
                $table->dropColumn('catatan');
            }
        });
    }
};
