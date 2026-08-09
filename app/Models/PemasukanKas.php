<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemasukanKas extends Model
{
    protected $primaryKey = 'id_pemasukan';
    protected $fillable = ['tanggal', 'nominal', 'keterangan', 'id_transaksi'];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'id_transaksi', 'id_transaksi');
    }
}
