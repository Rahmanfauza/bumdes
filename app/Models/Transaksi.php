<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnitUsaha;

class Transaksi extends Model
{
    protected $fillable = [
        'unit_usaha_id',
        'tanggal_transaksi',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
    ];

    public function unitUsaha()
    {
        return $this->belongsTo(UnitUsaha::class);
    }
}
