<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';
    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
