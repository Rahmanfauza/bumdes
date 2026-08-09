<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipDigital extends Model
{
    protected $primaryKey = 'id_arsip';
    protected $fillable = ['id_surat', 'nama_file', 'kategori', 'upload_date'];
    
    // Matikan update otomatis updated_at jika error, atau biarkan.
    // public $timestamps = false; // kalau tidak ada created_at updated_at

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat', 'id_surat');
    }
}
