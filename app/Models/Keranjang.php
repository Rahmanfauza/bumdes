<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs';
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_pelanggan',
        'tanggal',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function detail()
    {
        return $this->hasMany(DetailKeranjang::class, 'id_keranjang', 'id_keranjang');
    }

    /**
     * Hitung total nilai belanja di keranjang
     */
    public function getTotalBelanjaAttribute()
    {
        return $this->detail->sum('subtotal');
    }

    /**
     * Hitung total kuantitas item di keranjang
     */
    public function getTotalItemsAttribute()
    {
        return $this->detail->sum('jumlah');
    }
}
