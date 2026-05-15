<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukJasa extends Model
{
    protected $guarded = ['id'];

    public function unitUsaha()
    {
        return $this->belongsTo(UnitUsaha::class);
    }

    public function getNilaiPersediaanAttribute()
    {
        return $this->stok_awal * $this->harga_jual;
    }
}
