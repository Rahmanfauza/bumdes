<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $guarded = ['id'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
