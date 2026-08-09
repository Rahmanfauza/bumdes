<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'harga',
        'stok',
        'satuan',
        'status',
        'gambar',
        'deskripsi',
    ];

    /**
     * Relasi ke model KategoriProduk
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Accessor untuk mendapatkan URL lengkap gambar produk dengan fallback placeholder
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar && Storage::disk('public')->exists($this->gambar)) {
            return asset('storage/' . $this->gambar);
        }

        // Fallback jika tidak ada gambar
        return 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=600&auto=format&fit=crop';
    }
}
