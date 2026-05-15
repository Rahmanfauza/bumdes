<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $guarded = ['id'];

    public function akun()
    {
        return $this->belongsTo(AkunCoa::class, 'akun_coa_id');
    }
}
