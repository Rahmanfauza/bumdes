<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
