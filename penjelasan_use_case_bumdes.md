# Penjelasan Use Case Diagram Sistem BUMDes

## 1. Gambaran Umum

Use Case Diagram digunakan untuk menggambarkan interaksi antara pengguna
dengan sistem informasi BUMDes. Diagram ini menunjukkan aktor yang
menggunakan sistem serta fungsi atau layanan yang dapat dilakukan oleh
masing-masing aktor.

Berdasarkan Use Case Diagram, sistem memiliki lima aktor utama, yaitu
**Bendahara, Pelanggan, Sekretaris, Direktur, dan Admin**. Setiap aktor
memiliki hak akses dan fungsi yang berbeda sesuai dengan tugas serta
tanggung jawabnya dalam pengelolaan BUMDes.

Fungsi **login** menjadi mekanisme autentikasi yang digunakan oleh
pengguna untuk memperoleh akses terhadap fitur sistem sesuai dengan hak
aksesnya.

------------------------------------------------------------------------

## 2. Identifikasi Aktor

  -----------------------------------------------------------------------
  No.                     Aktor                   Deskripsi
  ----------------------- ----------------------- -----------------------
  1                       Bendahara               Pengguna yang
                                                  bertanggung jawab
                                                  terhadap pencatatan
                                                  pemasukan, pengeluaran,
                                                  dan pengelolaan laporan
                                                  keuangan BUMDes.

  2                       Pelanggan               Pengguna yang
                                                  menggunakan sistem
                                                  untuk melakukan
                                                  pembelian produk atau
                                                  jasa yang disediakan
                                                  oleh BUMDes.

  3                       Sekretaris              Pengguna yang
                                                  bertanggung jawab dalam
                                                  pengelolaan
                                                  administrasi persuratan
                                                  dan arsip dokumen
                                                  digital BUMDes.

  4                       Direktur                Pimpinan BUMDes yang
                                                  melakukan persetujuan
                                                  dokumen dan memantau
                                                  kondisi serta informasi
                                                  melalui dashboard.

  5                       Admin                   Pengguna yang mengelola
                                                  data produk dan jasa
                                                  serta mencatat
                                                  transaksi penjualan
                                                  pada sistem.
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## 3. Identifikasi Use Case

  -----------------------------------------------------------------------
  No.               Use Case          Aktor             Deskripsi
  ----------------- ----------------- ----------------- -----------------
  1                 Login             Bendahara,        Proses
                                      Pelanggan,        autentikasi
                                      Sekretaris,       pengguna sebelum
                                      Direktur, Admin   mengakses fitur
                                                        sistem.

  2                 Mencatat          Bendahara         Digunakan untuk
                    Pemasukan Kas                       mencatat setiap
                                                        pemasukan yang
                                                        diterima oleh
                                                        BUMDes.

  3                 Mencatat          Bendahara         Digunakan untuk
                    Pengeluaran Kas                     mencatat
                                                        pengeluaran atau
                                                        penggunaan dana
                                                        BUMDes.

  4                 Mengelola Laporan Bendahara         Digunakan untuk
                    Keuangan                            mengelola dan
                                                        melihat laporan
                                                        keuangan
                                                        berdasarkan data
                                                        pemasukan dan
                                                        pengeluaran.

  5                 Melakukan         Pelanggan         Digunakan
                    Pembelian                           pelanggan untuk
                                                        memilih dan
                                                        melakukan
                                                        pembelian produk
                                                        atau jasa BUMDes.

  6                 Mengelola         Sekretaris        Digunakan untuk
                    Administrasi                        mengelola surat
                    Persuratan                          dan administrasi
                                                        persuratan
                                                        BUMDes.

  7                 Mengelola Arsip   Sekretaris        Digunakan untuk
                    Digital                             menyimpan,
                                                        mengelola, dan
                                                        mengakses dokumen
                                                        atau arsip secara
                                                        digital.

  8                 Melakukan         Direktur          Digunakan
                    Approval Dokumen                    direktur untuk
                                                        memeriksa dan
                                                        memberikan
                                                        persetujuan
                                                        terhadap dokumen
                                                        yang membutuhkan
                                                        pengesahan.

  9                 Melihat Dashboard Direktur          Digunakan untuk
                                                        melihat ringkasan
                                                        informasi dan
                                                        kondisi
                                                        operasional
                                                        BUMDes melalui
                                                        dashboard.

  10                Mengelola Data    Admin             Digunakan untuk
                    Produk dan Jasa                     menambah,
                                                        mengubah,
                                                        menghapus, dan
                                                        mengelola
                                                        informasi produk
                                                        atau jasa BUMDes.

  11                Mencatat          Admin             Digunakan untuk
                    Transaksi                           mencatat
                    Penjualan                           transaksi
                                                        penjualan produk
                                                        atau jasa yang
                                                        dilakukan melalui
                                                        sistem.
  -----------------------------------------------------------------------

------------------------------------------------------------------------

## 4. Penjelasan Masing-Masing Use Case

### 4.1 Login

**Aktor:** Bendahara, Pelanggan, Sekretaris, Direktur, Admin

Login merupakan proses autentikasi yang dilakukan pengguna sebelum
menggunakan fitur sistem. Pengguna memasukkan kredensial yang telah
terdaftar. Sistem kemudian melakukan validasi terhadap data tersebut.

Jika data login benar, pengguna diarahkan ke halaman sesuai dengan hak
aksesnya. Jika data tidak valid, sistem menampilkan pesan kesalahan dan
pengguna tetap berada pada halaman login.

**Alur utama:**

1.  Pengguna membuka halaman login.
2.  Pengguna memasukkan username/email dan kata sandi.
3.  Sistem memvalidasi data pengguna.
4.  Sistem memeriksa hak akses pengguna.
5.  Sistem mengarahkan pengguna ke halaman yang sesuai dengan perannya.

------------------------------------------------------------------------

### 4.2 Mencatat Pemasukan Kas

**Aktor:** Bendahara

Use case ini digunakan oleh bendahara untuk mencatat pemasukan kas
BUMDes. Data yang dicatat dapat digunakan sebagai dasar dalam penyusunan
laporan keuangan.

**Alur utama:**

1.  Bendahara login ke sistem.
2.  Bendahara membuka menu pemasukan kas.
3.  Bendahara memasukkan data pemasukan.
4.  Sistem melakukan validasi data.
5.  Bendahara menyimpan data.
6.  Sistem menyimpan data pemasukan ke dalam basis data.

------------------------------------------------------------------------

### 4.3 Mencatat Pengeluaran Kas

**Aktor:** Bendahara

Use case ini digunakan untuk mencatat seluruh pengeluaran kas BUMDes.
Pencatatan dilakukan agar setiap penggunaan dana dapat terdokumentasi
dan digunakan dalam proses pelaporan keuangan.

**Alur utama:**

1.  Bendahara membuka menu pengeluaran kas.
2.  Bendahara memasukkan informasi pengeluaran.
3.  Sistem memvalidasi data.
4.  Bendahara menyimpan data.
5.  Sistem mencatat pengeluaran ke dalam basis data.

------------------------------------------------------------------------

### 4.4 Mengelola Laporan Keuangan

**Aktor:** Bendahara

Use case ini digunakan oleh bendahara untuk mengelola dan memantau
laporan keuangan berdasarkan data pemasukan dan pengeluaran yang telah
dicatat.

**Alur utama:**

1.  Bendahara membuka menu laporan keuangan.
2.  Sistem mengambil data transaksi keuangan.
3.  Sistem mengolah data pemasukan dan pengeluaran.
4.  Sistem menampilkan laporan keuangan.
5.  Bendahara dapat melakukan pemeriksaan terhadap laporan yang
    ditampilkan.

------------------------------------------------------------------------

### 4.5 Melakukan Pembelian

**Aktor:** Pelanggan

Use case ini digunakan pelanggan untuk melakukan pembelian produk atau
jasa yang tersedia pada BUMDes.

**Alur utama:**

1.  Pelanggan mengakses katalog produk atau jasa.
2.  Pelanggan memilih produk atau jasa.
3.  Pelanggan menentukan jumlah pembelian.
4.  Sistem menghitung total transaksi.
5.  Pelanggan melakukan konfirmasi pembelian.
6.  Sistem menyimpan data transaksi pembelian.

------------------------------------------------------------------------

### 4.6 Mengelola Administrasi Persuratan

**Aktor:** Sekretaris

Use case ini digunakan sekretaris untuk mengelola administrasi
surat-menyurat BUMDes, baik surat masuk maupun surat keluar sesuai
kebutuhan organisasi.

**Alur utama:**

1.  Sekretaris membuka menu administrasi persuratan.
2.  Sekretaris menambahkan atau memilih data surat.
3.  Sekretaris mengisi informasi surat.
4.  Sistem memvalidasi data.
5.  Sistem menyimpan data persuratan.
6.  Data surat dapat ditampilkan kembali untuk kebutuhan administrasi.

------------------------------------------------------------------------

### 4.7 Mengelola Arsip Digital

**Aktor:** Sekretaris

Use case ini digunakan untuk mengelola dokumen BUMDes dalam bentuk
digital sehingga dokumen dapat disimpan dan ditemukan kembali dengan
lebih mudah.

**Alur utama:**

1.  Sekretaris membuka menu arsip digital.
2.  Sekretaris mengunggah atau memilih dokumen.
3.  Sekretaris memasukkan informasi dokumen.
4.  Sistem menyimpan dokumen dan metadata arsip.
5.  Sekretaris dapat melihat atau mencari dokumen yang telah tersimpan.

------------------------------------------------------------------------

### 4.8 Melakukan Approval Dokumen

**Aktor:** Direktur

Use case ini digunakan direktur untuk melakukan pemeriksaan dan
memberikan persetujuan terhadap dokumen yang membutuhkan pengesahan.

**Alur utama:**

1.  Direktur login ke sistem.
2.  Direktur membuka daftar dokumen yang menunggu persetujuan.
3.  Direktur melihat detail dokumen.
4.  Direktur melakukan pemeriksaan.
5.  Direktur memberikan keputusan persetujuan atau penolakan.
6.  Sistem menyimpan status approval dokumen.

------------------------------------------------------------------------

### 4.9 Melihat Dashboard

**Aktor:** Direktur

Use case ini digunakan direktur untuk melihat informasi ringkas mengenai
kondisi operasional BUMDes. Dashboard dapat menampilkan informasi yang
berasal dari data transaksi, keuangan, produk, dan aktivitas lainnya.

**Alur utama:**

1.  Direktur login ke sistem.
2.  Sistem menampilkan dashboard.
3.  Sistem mengambil data yang diperlukan.
4.  Sistem menampilkan informasi dalam bentuk ringkasan.
5.  Direktur melakukan pemantauan berdasarkan informasi yang tersedia.

------------------------------------------------------------------------

### 4.10 Mengelola Data Produk dan Jasa

**Aktor:** Admin

Use case ini digunakan admin untuk mengelola data produk dan jasa yang
ditawarkan oleh BUMDes.

Pengelolaan dapat meliputi proses **menambah, melihat, mengubah, dan
menghapus data** produk atau jasa.

**Alur utama:**

1.  Admin login ke sistem.
2.  Admin membuka menu produk dan jasa.
3.  Admin memilih operasi yang diperlukan.
4.  Admin memasukkan atau mengubah data.
5.  Sistem melakukan validasi.
6.  Sistem menyimpan perubahan data.

------------------------------------------------------------------------

### 4.11 Mencatat Transaksi Penjualan

**Aktor:** Admin

Use case ini digunakan admin untuk mencatat transaksi penjualan yang
dilakukan melalui sistem. Data transaksi dapat digunakan sebagai sumber
informasi untuk pengelolaan penjualan dan laporan BUMDes.

**Alur utama:**

1.  Admin membuka menu transaksi penjualan.
2.  Admin memilih produk atau jasa yang dibeli.
3.  Admin memasukkan jumlah transaksi.
4.  Sistem menghitung total transaksi.
5.  Admin melakukan konfirmasi transaksi.
6.  Sistem menyimpan data transaksi penjualan.

------------------------------------------------------------------------

## 5. Hubungan Aktor dengan Sistem

### 5.1 Bendahara

Bendahara memiliki akses terhadap fungsi yang berkaitan dengan
pengelolaan keuangan. Setelah melakukan login, bendahara dapat:

-   Mencatat pemasukan kas.
-   Mencatat pengeluaran kas.
-   Mengelola laporan keuangan.

### 5.2 Pelanggan

Pelanggan menggunakan sistem untuk melakukan aktivitas pembelian.
Setelah melakukan login, pelanggan dapat:

-   Melihat produk atau jasa yang tersedia.
-   Memilih produk atau jasa.
-   Melakukan pembelian.

### 5.3 Sekretaris

Sekretaris menggunakan sistem untuk mendukung kegiatan administrasi
BUMDes. Setelah melakukan login, sekretaris dapat:

-   Mengelola administrasi persuratan.
-   Mengelola arsip digital.

### 5.4 Direktur

Direktur menggunakan sistem untuk melakukan pengawasan dan pengambilan
keputusan administratif. Setelah melakukan login, direktur dapat:

-   Melakukan approval dokumen.
-   Melihat dashboard.

### 5.5 Admin

Admin berperan dalam pengelolaan data operasional penjualan. Setelah
melakukan login, admin dapat:

-   Mengelola data produk dan jasa.
-   Mencatat transaksi penjualan.

------------------------------------------------------------------------

## 6. Kesimpulan

Use Case Diagram menunjukkan bahwa sistem informasi BUMDes memiliki
pembagian hak akses berdasarkan peran masing-masing pengguna.
**Bendahara** berfokus pada pengelolaan keuangan, **Pelanggan** pada
aktivitas pembelian, **Sekretaris** pada administrasi dan arsip digital,
**Direktur** pada proses persetujuan serta pemantauan dashboard,
sedangkan **Admin** berfokus pada pengelolaan produk, jasa, dan
transaksi penjualan.

Seluruh aktor yang membutuhkan akses internal terhadap sistem terlebih
dahulu melakukan proses **login**. Pembagian fungsi berdasarkan aktor
tersebut bertujuan untuk menjaga keteraturan proses bisnis, membatasi
akses sesuai tanggung jawab pengguna, serta mendukung pengelolaan data
BUMDes secara terstruktur dan terdokumentasi.
