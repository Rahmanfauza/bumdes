import os
import re
import glob

migrations_dir = r"c:\Users\Administrator\Desktop\bumdes\database\migrations"

schemas = {
    "create_roles_table": """            $table->id('id_role');
            $table->string('nama_role');
            $table->timestamps();""",
    "create_kategori_produks_table": """            $table->id('id_kategori');
            $table->string('nama_kategori');
            $table->timestamps();""",
    "create_produks_table": """            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_produk');
            $table->decimal('harga', 15, 2);
            $table->integer('stok');
            $table->string('satuan');
            $table->string('status')->default('aktif');
            $table->timestamps();
            
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_produks')->onDelete('cascade');""",
    "create_pelanggans_table": """            $table->id('id_pelanggan');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status')->default('aktif');
            $table->timestamps();""",
    "create_transaksi_penjualans_table": """            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->dateTime('tanggal');
            $table->decimal('total', 15, 2);
            $table->string('metode_bayar');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans');""",
    "create_detail_transaksis_table": """            $table->id('id_detail');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
            
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi_penjualans')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produks');""",
    "create_keranjangs_table": """            $table->id('id_keranjang');
            $table->unsignedBigInteger('id_pelanggan');
            $table->dateTime('tanggal');
            $table->timestamps();
            
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');""",
    "create_detail_keranjangs_table": """            $table->id('id_detail');
            $table->unsignedBigInteger('id_keranjang');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
            
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjangs')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produks');""",
    "create_surats_table": """            $table->id('id_surat');
            $table->string('nomor_surat');
            $table->string('jenis_surat');
            $table->string('perihal');
            $table->string('penerima')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('status');
            $table->timestamps();""",
    "create_approval_dokumens_table": """            $table->id('id_approval');
            $table->unsignedBigInteger('id_surat');
            $table->date('tanggal_approval');
            $table->string('status');
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_surat')->references('id_surat')->on('surats')->onDelete('cascade');""",
    "create_arsip_digitals_table": """            $table->id('id_arsip');
            $table->unsignedBigInteger('id_surat')->nullable();
            $table->string('nama_file');
            $table->string('kategori')->nullable();
            $table->dateTime('upload_date');
            $table->timestamps();
            
            $table->foreign('id_surat')->references('id_surat')->on('surats')->onDelete('cascade');""",
    "create_pemasukan_kas_table": """            $table->id('id_pemasukan');
            $table->date('tanggal');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();""",
    "create_pengeluaran_kas_table": """            $table->id('id_pengeluaran');
            $table->date('tanggal');
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();""",
    "create_laporan_keuangans_table": """            $table->id('id_laporan');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->decimal('total_pemasukan', 15, 2);
            $table->decimal('total_pengeluaran', 15, 2);
            $table->decimal('saldo', 15, 2);
            $table->timestamps();"""
}

files = glob.glob(os.path.join(migrations_dir, "*.php"))

for f in files:
    filename = os.path.basename(f)
    for key in schemas.keys():
        if key in filename:
            with open(f, 'r') as file:
                content = file.read()
            
            # Replace the default columns with our schema
            pattern = r"\$table->id\(\);[\s\n]*\$table->timestamps\(\);"
            replacement = schemas[key]
            
            new_content = re.sub(pattern, replacement, content)
            
            with open(f, 'w') as file:
                file.write(new_content)
            print(f"Updated {filename}")
