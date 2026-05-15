<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnitUsaha;

class Transaksi extends Model
{
    protected $fillable = [
        'unit_usaha_id',
        'pelanggan_id',
        'tanggal_transaksi',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
    ];

    public function unitUsaha()
    {
        return $this->belongsTo(UnitUsaha::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
