<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Storage;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure storage folder exists
        Storage::disk('public')->makeDirectory('produk');

        $katTani = KategoriProduk::firstOrCreate(['nama_kategori' => 'Hasil Tani & Perkebunan']);
        $katKerajinan = KategoriProduk::firstOrCreate(['nama_kategori' => 'Kerajinan Desa']);
        $katKuliner = KategoriProduk::firstOrCreate(['nama_kategori' => 'Kuliner & Olahan']);

        $sampleProducts = [
            [
                'nama_produk' => 'Madu Hutan Murni 500ml',
                'id_kategori' => $katTani->id_kategori,
                'harga' => 120000,
                'stok' => 25,
                'satuan' => 'botol',
                'status' => 'aktif',
                'deskripsi' => 'Madu lebah liar hutan asli tanpa campuran bahan pengawet, kaya akan nutrisi dan antioksidan.',
                'image_url' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=600&auto=format&fit=crop&q=80',
                'filename' => 'madu.jpg',
            ],
            [
                'nama_produk' => 'Kopi Arabika Lereng Gunung 250g',
                'id_kategori' => $katTani->id_kategori,
                'harga' => 45000,
                'stok' => 40,
                'satuan' => 'bungkus',
                'status' => 'aktif',
                'deskripsi' => 'Biji kopi pilihan roasted medium dark dengan aroma harum khas dataran tinggi desa.',
                'image_url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=600&auto=format&fit=crop&q=80',
                'filename' => 'kopi.jpg',
            ],
            [
                'nama_produk' => 'Lampu Hias Anyaman Bambu',
                'id_kategori' => $katKerajinan->id_kategori,
                'harga' => 85000,
                'stok' => 15,
                'satuan' => 'unit',
                'status' => 'aktif',
                'deskripsi' => 'Kap lampu artistik buatan tangan kelompok pengrajin bambu desa berkualitas ekspor.',
                'image_url' => 'https://images.unsplash.com/photo-1516054817101-9dcbe768ef60?w=600&auto=format&fit=crop&q=80',
                'filename' => 'bambu.jpg',
            ],
            [
                'nama_produk' => 'Beras Organik Pandan Wangi 5Kg',
                'id_kategori' => $katTani->id_kategori,
                'harga' => 75000,
                'stok' => 50,
                'satuan' => 'karung',
                'status' => 'aktif',
                'deskripsi' => 'Beras pulen aroma wangi alami dari sawah irigasi pegunungan tanpa pemutih sintetis.',
                'image_url' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600&auto=format&fit=crop&q=80',
                'filename' => 'beras.jpg',
            ],
            [
                'nama_produk' => 'Keripik Singkong Renyah 500g',
                'id_kategori' => $katKuliner->id_kategori,
                'harga' => 20000,
                'stok' => 30,
                'satuan' => 'bungkus',
                'status' => 'aktif',
                'deskripsi' => 'Camilan keripik gurih renyah olahan kelompok ibu-ibu PKK desa dari singkong segar panen kebun.',
                'image_url' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=600&auto=format&fit=crop&q=80',
                'filename' => 'keripik.jpg',
            ],
        ];

        foreach ($sampleProducts as $p) {
            $imagePath = 'produk/' . $p['filename'];
            
            // Try downloading sample image if not exists
            if (!Storage::disk('public')->exists($imagePath)) {
                try {
                    $imageContent = @file_get_contents($p['image_url']);
                    if ($imageContent) {
                        Storage::disk('public')->put($imagePath, $imageContent);
                    }
                } catch (\Exception $e) {
                    // Ignore network issues
                }
            }

            Produk::updateOrCreate(
                ['nama_produk' => $p['nama_produk']],
                [
                    'id_kategori' => $p['id_kategori'],
                    'harga' => $p['harga'],
                    'stok' => $p['stok'],
                    'satuan' => $p['satuan'],
                    'status' => $p['status'],
                    'deskripsi' => $p['deskripsi'],
                    'gambar' => Storage::disk('public')->exists($imagePath) ? $imagePath : null,
                ]
            );
        }
    }
}
