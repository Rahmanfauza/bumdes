<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relasi ke Keranjang belanja aktif milik pelanggan
     */
    public function keranjang()
    {
        return $this->hasOne(Keranjang::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Relasi ke riwayat transaksi penjualan
     */
    public function transaksis()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
