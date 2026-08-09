<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $primaryKey = 'id_surat';
    protected $fillable = ['nomor_surat', 'jenis_surat', 'perihal', 'penerima', 'pengirim', 'status'];

    public function arsip()
    {
        return $this->hasOne(ArsipDigital::class, 'id_surat', 'id_surat');
    }
}
