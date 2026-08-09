# Penjelasan Class Diagram dan Struktur Database Sistem BUMDes

## 1. Gambaran Umum

Class Diagram menggambarkan struktur data dan hubungan antarobjek yang
digunakan dalam sistem informasi BUMDes. Setiap class merepresentasikan
entitas atau tabel yang menyimpan data tertentu, sedangkan atribut
menunjukkan data yang dimiliki oleh entitas dan method menggambarkan
operasi yang dapat dilakukan terhadap data tersebut.

Class Diagram sistem BUMDes terdiri dari beberapa kelompok data utama,
yaitu **manajemen pengguna dan hak akses, pelanggan, produk, transaksi
penjualan, keuangan, administrasi surat, arsip digital, approval
dokumen, serta dashboard**.

Struktur tersebut dirancang agar data antarbagian sistem dapat saling
terhubung dan mendukung proses bisnis BUMDes secara terintegrasi.

------------------------------------------------------------------------

## 2. Struktur Entitas Database

Berdasarkan Class Diagram, sistem memiliki **17 class utama**, yaitu:

1.  Role
2.  User
3.  Pelanggan
4.  KategoriProduk
5.  Produk
6.  TransaksiPenjualan
7.  DetailTransaksi
8.  Keranjang
9.  DetailKeranjang
10. PemasukanKas
11. PengeluaranKas
12. LaporanKeuangan
13. Surat
14. ApprovalDokumen
15. ArsipDigital
16. Dashboard
17. Relasi antarentitas sebagai bagian dari integrasi data sistem

------------------------------------------------------------------------

## 3. Penjelasan Setiap Class

### 3.1 Role

Class **Role** digunakan untuk menyimpan data hak akses atau peran
pengguna dalam sistem.

**Atribut:**

  Atribut     Tipe     Keterangan
  ----------- -------- -------------------------------
  id_role     int      Identitas unik role
  nama_role   string   Nama atau jenis role pengguna

**Method:**

-   `tambahRole()` untuk menambahkan role baru.
-   `ubahRole()` untuk mengubah data role.
-   `hapusRole()` untuk menghapus role.

Role berhubungan dengan class **User**, sehingga setiap pengguna dapat
memiliki peran tertentu sesuai hak akses yang diberikan.

------------------------------------------------------------------------

### 3.2 User

Class **User** merupakan entitas utama untuk menyimpan data akun
pengguna yang dapat mengakses sistem.

**Atribut:**

  Atribut    Tipe     Keterangan
  ---------- -------- ----------------------------
  id_user    int      Identitas unik pengguna
  nama       string   Nama pengguna
  username   string   Username untuk autentikasi
  password   string   Kata sandi pengguna
  email      string   Email pengguna
  no_hp      string   Nomor telepon pengguna
  status     enum     Status akun pengguna

**Method:**

-   `login()` untuk melakukan autentikasi.
-   `logout()` untuk mengakhiri sesi pengguna.
-   `ubahProfil()` untuk mengubah informasi profil.

Class User memiliki hubungan dengan **Role** dan digunakan oleh beberapa
proses sistem seperti transaksi penjualan.

------------------------------------------------------------------------

### 3.3 Pelanggan

Class **Pelanggan** digunakan untuk menyimpan informasi pelanggan
BUMDes.

**Atribut:**

  Atribut        Tipe     Keterangan
  -------------- -------- --------------------------
  id_pelanggan   int      Identitas unik pelanggan
  nama           string   Nama pelanggan
  email          string   Email pelanggan
  no_hp          string   Nomor telepon pelanggan
  alamat         string   Alamat pelanggan
  status         enum     Status pelanggan

**Method:**

-   `daftar()` untuk melakukan pendaftaran pelanggan.
-   `login()` untuk masuk ke sistem.
-   `ubahProfil()` untuk mengubah data pelanggan.

Data pelanggan digunakan pada proses **keranjang** dan **transaksi
penjualan**.

------------------------------------------------------------------------

### 3.4 KategoriProduk

Class **KategoriProduk** digunakan untuk mengelompokkan produk
berdasarkan kategori tertentu.

**Atribut:**

  Atribut         Tipe     Keterangan
  --------------- -------- -------------------------
  id_kategori     int      Identitas unik kategori
  nama_kategori   string   Nama kategori produk

**Method:**

-   `tambahKategori()` untuk menambahkan kategori.
-   `ubahKategori()` untuk mengubah kategori.
-   `hapusKategori()` untuk menghapus kategori.

Satu kategori dapat digunakan oleh beberapa produk.

------------------------------------------------------------------------

### 3.5 Produk

Class **Produk** menyimpan informasi produk atau jasa yang dikelola oleh
BUMDes.

**Atribut:**

  Atribut       Tipe      Keterangan
  ------------- --------- ---------------------------
  id_produk     int       Identitas unik produk
  id_kategori   int       Referensi kategori produk
  nama_produk   string    Nama produk
  harga         decimal   Harga produk
  stok          int       Jumlah stok
  satuan        string    Satuan produk
  status        enum      Status produk

**Method:**

-   `tambahProduk()` untuk menambahkan produk.
-   `ubahProduk()` untuk mengubah informasi produk.
-   `hapusProduk()` untuk menghapus produk.

Produk berhubungan dengan **KategoriProduk**, **DetailTransaksi**, dan
**DetailKeranjang**.

------------------------------------------------------------------------

### 3.6 TransaksiPenjualan

Class **TransaksiPenjualan** digunakan untuk menyimpan informasi
transaksi penjualan.

**Atribut:**

  Atribut        Tipe       Keterangan
  -------------- ---------- ------------------------------------
  id_transaksi   int        Identitas unik transaksi
  id_user        int        Pengguna yang mencatat transaksi
  id_pelanggan   int        Pelanggan yang melakukan transaksi
  tanggal        datetime   Waktu transaksi
  total          decimal    Total nilai transaksi
  metode_bayar   string     Metode pembayaran
  status         enum       Status transaksi

**Method:**

-   `simpan()` untuk menyimpan transaksi.
-   `hitungTotal()` untuk menghitung total transaksi.
-   `batalkan()` untuk membatalkan transaksi.

Satu transaksi dapat memiliki beberapa **DetailTransaksi**.

------------------------------------------------------------------------

### 3.7 DetailTransaksi

Class **DetailTransaksi** digunakan untuk menyimpan rincian produk yang
terdapat dalam suatu transaksi.

**Atribut:**

  Atribut        Tipe      Keterangan
  -------------- --------- -----------------------------
  id_detail      int       Identitas detail transaksi
  id_transaksi   int       Referensi transaksi
  id_produk      int       Referensi produk
  jumlah         int       Jumlah produk
  harga          decimal   Harga produk saat transaksi
  subtotal       decimal   Nilai subtotal

**Method:**

-   `hitungSubtotal()` untuk menghitung nilai subtotal berdasarkan
    jumlah dan harga.

Detail transaksi menghubungkan **TransaksiPenjualan** dengan **Produk**.

------------------------------------------------------------------------

### 3.8 Keranjang

Class **Keranjang** digunakan untuk menyimpan data keranjang belanja
pelanggan sebelum transaksi dikonfirmasi.

**Atribut:**

  Atribut        Tipe   Keterangan
  -------------- ------ --------------------------
  id_keranjang   int    Identitas keranjang
  id_pelanggan   int    Referensi pelanggan
  tanggal        date   Tanggal keranjang dibuat

**Method:**

-   `tambahItem()` untuk menambahkan produk ke keranjang.
-   `hapusItem()` untuk menghapus produk dari keranjang.
-   `checkout()` untuk melakukan proses pembelian.

Satu keranjang dapat memiliki beberapa **DetailKeranjang**.

------------------------------------------------------------------------

### 3.9 DetailKeranjang

Class **DetailKeranjang** digunakan untuk menyimpan rincian produk yang
terdapat pada keranjang pelanggan.

**Atribut:**

  Atribut        Tipe      Keterangan
  -------------- --------- ----------------------------
  id_detail      int       Identitas detail keranjang
  id_keranjang   int       Referensi keranjang
  id_produk      int       Referensi produk
  jumlah         int       Jumlah produk
  harga          decimal   Harga produk
  subtotal       decimal   Nilai subtotal

Class ini menghubungkan **Keranjang** dengan **Produk**.

------------------------------------------------------------------------

### 3.10 PemasukanKas

Class **PemasukanKas** digunakan untuk mencatat pemasukan keuangan
BUMDes.

**Atribut:**

  Atribut        Tipe      Keterangan
  -------------- --------- ----------------------
  id_pemasukan   int       Identitas pemasukan
  tanggal        date      Tanggal pemasukan
  nominal        decimal   Nilai pemasukan
  keterangan     string    Keterangan transaksi

**Method:**

-   `simpan()` untuk menyimpan data pemasukan.

Data pemasukan digunakan sebagai salah satu sumber dalam penyusunan
**LaporanKeuangan**.

------------------------------------------------------------------------

### 3.11 PengeluaranKas

Class **PengeluaranKas** digunakan untuk mencatat pengeluaran dana
BUMDes.

**Atribut:**

  Atribut          Tipe      Keterangan
  ---------------- --------- -----------------------
  id_pengeluaran   int       Identitas pengeluaran
  tanggal          date      Tanggal pengeluaran
  nominal          decimal   Nilai pengeluaran
  keterangan       string    Keterangan transaksi

**Method:**

-   `simpan()` untuk menyimpan data pengeluaran.

Data pengeluaran digunakan bersama data pemasukan dalam penyusunan
laporan keuangan.

------------------------------------------------------------------------

### 3.12 LaporanKeuangan

Class **LaporanKeuangan** digunakan untuk menghasilkan informasi
keuangan BUMDes berdasarkan data pemasukan dan pengeluaran.

**Atribut:**

  Atribut             Tipe      Keterangan
  ------------------- --------- -----------------------------------
  id_laporan          int       Identitas laporan
  periode_awal        date      Awal periode laporan
  periode_akhir       date      Akhir periode laporan
  total_pemasukan     decimal   Total pemasukan
  total_pengeluaran   decimal   Total pengeluaran
  saldo               decimal   Selisih pemasukan dan pengeluaran

**Method:**

-   `generateLaporan()` untuk menghasilkan laporan.
-   `export()` untuk mengekspor laporan.

Secara konsep, saldo dapat diperoleh dari:

**Saldo = Total Pemasukan - Total Pengeluaran**

------------------------------------------------------------------------

### 3.13 Surat

Class **Surat** digunakan untuk menyimpan data administrasi persuratan
BUMDes.

**Atribut:**

  Atribut       Tipe     Keterangan
  ------------- -------- -----------------
  id_surat      int      Identitas surat
  nomor_surat   string   Nomor surat
  jenis_surat   string   Jenis surat
  perihal       string   Perihal surat
  penerima      string   Pihak penerima
  pengirim      string   Pihak pengirim
  status        enum     Status surat

**Method:**

-   `tambahSurat()` untuk menambahkan data surat.
-   `ubahSurat()` untuk mengubah data surat.

Data surat dapat digunakan dalam proses **ApprovalDokumen** dan
pengarsipan digital.

------------------------------------------------------------------------

### 3.14 ApprovalDokumen

Class **ApprovalDokumen** digunakan untuk mencatat proses persetujuan
dokumen oleh pihak yang memiliki kewenangan.

**Atribut:**

  Atribut            Tipe     Keterangan
  ------------------ -------- ---------------------
  id_approval        int      Identitas approval
  tanggal_approval   date     Tanggal persetujuan
  status             enum     Status persetujuan
  catatan            string   Catatan approval

**Method:**

-   `setujui()` untuk memberikan persetujuan.
-   `tolak()` untuk menolak dokumen.

Class ini berkaitan dengan proses persetujuan dokumen administrasi
BUMDes.

------------------------------------------------------------------------

### 3.15 ArsipDigital

Class **ArsipDigital** digunakan untuk menyimpan informasi dokumen yang
telah diarsipkan dalam bentuk digital.

**Atribut:**

  Atribut     Tipe       Keterangan
  ----------- ---------- ------------------------
  id_arsip    int        Identitas arsip
  nama_file   string     Nama file dokumen
  kategori    string     Kategori dokumen
  upload      datetime   Waktu dokumen diunggah

**Method:**

-   `upload()` untuk mengunggah dokumen.
-   `download()` untuk mengunduh dokumen.

Arsip digital mendukung proses penyimpanan dokumen secara terstruktur
sehingga dokumen dapat dikelola dan diakses kembali.

------------------------------------------------------------------------

### 3.16 Dashboard

Class **Dashboard** digunakan untuk menyediakan ringkasan informasi
operasional BUMDes.

**Atribut:**

  Atribut             Tipe      Keterangan
  ------------------- --------- -----------------------
  total_produk        int       Jumlah produk
  total_surat         int       Jumlah surat
  total_penjualan     decimal   Total nilai penjualan
  total_pemasukan     decimal   Total pemasukan
  total_pengeluaran   decimal   Total pengeluaran
  saldo               decimal   Saldo keuangan

**Method:**

-   `tampilkan()` untuk menampilkan informasi ringkasan pada dashboard.

Dashboard mengambil data dari beberapa bagian sistem sehingga pengguna
dengan hak akses tertentu dapat memperoleh informasi secara ringkas.

------------------------------------------------------------------------

# 4. Relasi Antar Class

## 4.1 Role dan User

Class **Role** berhubungan dengan **User** untuk menentukan hak akses
pengguna. Satu role dapat digunakan oleh satu atau lebih user, sedangkan
setiap user memiliki role tertentu.

Secara database, relasi ini dapat direpresentasikan menggunakan
`id_role` sebagai foreign key pada tabel `users`.

------------------------------------------------------------------------

## 4.2 KategoriProduk dan Produk

Satu **KategoriProduk** dapat memiliki banyak **Produk**. Setiap produk
berada dalam satu kategori.

**Relasi:**

`KategoriProduk 1 : N Produk`

------------------------------------------------------------------------

## 4.3 User, Pelanggan, dan TransaksiPenjualan

Class **TransaksiPenjualan** menyimpan referensi terhadap user yang
mencatat transaksi dan pelanggan yang melakukan transaksi.

**Relasi:**

`User 1 : N TransaksiPenjualan`

`Pelanggan 1 : N TransaksiPenjualan`

Dengan demikian, satu user dapat mencatat banyak transaksi dan satu
pelanggan dapat memiliki banyak riwayat transaksi.

------------------------------------------------------------------------

## 4.4 TransaksiPenjualan dan DetailTransaksi

Satu transaksi dapat terdiri dari beberapa produk. Oleh karena itu,
class **TransaksiPenjualan** memiliki hubungan satu ke banyak dengan
**DetailTransaksi**.

**Relasi:**

`TransaksiPenjualan 1 : N DetailTransaksi`

Setiap detail transaksi menyimpan produk, jumlah, harga, dan subtotal.

------------------------------------------------------------------------

## 4.5 Produk dan DetailTransaksi

Satu produk dapat muncul pada banyak detail transaksi yang berbeda.

**Relasi:**

`Produk 1 : N DetailTransaksi`

Relasi ini memungkinkan sistem mengetahui produk apa saja yang pernah
terjual.

------------------------------------------------------------------------

## 4.6 Pelanggan dan Keranjang

Setiap pelanggan dapat memiliki keranjang belanja. Keranjang digunakan
sebagai tempat penyimpanan sementara produk sebelum checkout.

**Relasi:**

`Pelanggan 1 : N Keranjang`

------------------------------------------------------------------------

## 4.7 Keranjang dan DetailKeranjang

Satu keranjang dapat memiliki beberapa item produk.

**Relasi:**

`Keranjang 1 : N DetailKeranjang`

Detail keranjang menyimpan produk, jumlah, harga, dan subtotal dari item
yang dipilih pelanggan.

------------------------------------------------------------------------

## 4.8 Produk dan DetailKeranjang

Satu produk dapat terdapat pada banyak detail keranjang milik pelanggan
yang berbeda.

**Relasi:**

`Produk 1 : N DetailKeranjang`

------------------------------------------------------------------------

## 4.9 PemasukanKas dan LaporanKeuangan

Data pemasukan kas digunakan sebagai sumber perhitungan laporan
keuangan. Total pemasukan dalam periode tertentu dihitung berdasarkan
data pemasukan yang tercatat.

------------------------------------------------------------------------

## 4.10 PengeluaranKas dan LaporanKeuangan

Data pengeluaran kas digunakan untuk menghitung total pengeluaran dalam
suatu periode. Data tersebut kemudian digunakan bersama pemasukan untuk
memperoleh saldo.

------------------------------------------------------------------------

## 4.11 Surat, ApprovalDokumen, dan ArsipDigital

Class **Surat** digunakan untuk menyimpan data administrasi surat.
Dokumen tertentu dapat melalui proses **ApprovalDokumen** sebelum
dinyatakan disetujui.

Dokumen yang telah dikelola juga dapat disimpan pada **ArsipDigital**
untuk kebutuhan dokumentasi dan pencarian kembali.

------------------------------------------------------------------------

# 5. Struktur Database yang Direkomendasikan

Berdasarkan class diagram, struktur tabel database dapat dikelompokkan
menjadi:

### A. Tabel Manajemen Pengguna

-   `roles`
-   `users`
-   `pelanggans`

### B. Tabel Produk dan Penjualan

-   `kategori_produk`
-   `produk`
-   `keranjang`
-   `detail_keranjang`
-   `transaksi_penjualan`
-   `detail_transaksi`

### C. Tabel Keuangan

-   `pemasukan_kas`
-   `pengeluaran_kas`
-   `laporan_keuangan`

### D. Tabel Administrasi dan Dokumen

-   `surat`
-   `approval_dokumen`
-   `arsip_digital`

### E. Dashboard

Dashboard tidak harus dibuat sebagai tabel database tersendiri karena
data dashboard dapat diperoleh melalui query dan agregasi dari tabel
transaksi, produk, surat, pemasukan, dan pengeluaran.

------------------------------------------------------------------------

# 6. Integrasi Alur Data

Secara umum, alur data pada sistem dapat digambarkan sebagai berikut:

``` text
Role
  ↓
User
  ↓
Hak Akses Sistem
  │
  ├── Pengelolaan Produk
  │      ↓
  │   KategoriProduk → Produk
  │                       ↓
  │              Keranjang → DetailKeranjang
  │                       ↓
  │                  Checkout
  │                       ↓
  │             TransaksiPenjualan
  │                       ↓
  │              DetailTransaksi
  │
  ├── Keuangan
  │      ├── PemasukanKas
  │      └── PengeluaranKas
  │                 ↓
  │          LaporanKeuangan
  │
  └── Administrasi
         ↓
       Surat
         ├── ApprovalDokumen
         └── ArsipDigital

Seluruh data utama
       ↓
   Dashboard
```

------------------------------------------------------------------------

# 7. Kesimpulan

Class Diagram sistem BUMDes menunjukkan struktur basis data yang
mendukung beberapa proses utama, yaitu autentikasi pengguna, pengelolaan
produk dan jasa, transaksi penjualan, pengelolaan keuangan, administrasi
persuratan, pengarsipan dokumen, dan pemantauan melalui dashboard.

Relasi antarclass dirancang untuk menjaga keterhubungan data. Data
produk terhubung dengan kategori dan transaksi, data transaksi terhubung
dengan pelanggan serta pengguna, sedangkan data pemasukan dan
pengeluaran digunakan sebagai dasar penyusunan laporan keuangan.

Dengan struktur tersebut, basis data dapat mendukung proses bisnis
BUMDes secara terintegrasi serta memudahkan pengelolaan, pencarian, dan
penyajian informasi sesuai dengan hak akses masing-masing pengguna.
