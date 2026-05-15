<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunCoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_akun',
        'nama_akun',
        'kelompok',
        'saldo_nominal',
    ];

    public function jurnals()
    {
        return $this->hasMany(Jurnal::class, 'akun_coa_id');
    }
}
