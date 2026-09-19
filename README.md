# Kasir Web - Junior Web Programming

Aplikasi web kasir sederhana berbasis PHP dan MySQL untuk pengelolaan barang, pelanggan, transaksi penjualan, stok, dan laporan.

## Struktur Proyek

- `index.php` — pengarah awal ke login/dashboard.
- `login.php` — halaman login.
- `proses_login.php` — proses autentikasi.
- `auth.php` — pemeriksaan session dan fungsi keamanan output.
- `dashboard.php` — ringkasan data kasir.
- `header.php` / `footer.php` — layout bersama dan SweetAlert2.
- `style.css` — stylesheet aplikasi.
- `barang*.php` — CRUD data barang.
- `pelanggan*.php` — CRUD data pelanggan.
- `transaksi.php` — daftar transaksi.
- `transaksi_tambah.php` — form transaksi dan struktur data array.
- `transaksi_simpan.php` — validasi, penyimpanan transaksi, detail, dan pengurangan stok.
- `transaksi_detail.php` — detail transaksi.
- `laporan.php` — laporan penjualan.
- `koneksi.php` — koneksi database MySQL.
- `database.sql` — struktur dan data awal database.

## Teknologi

- PHP 8.x
- MySQL/MariaDB
- Apache (XAMPP/Laragon)
- HTML5 dan CSS3
- JavaScript
- SweetAlert2 melalui CDN

## Cara Menjalankan

1. Salin folder `kasir_web` ke `C:\xampp\htdocs\`.
2. Jalankan Apache dan MySQL pada XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Buat/import database dari `database.sql` dengan nama database `kasir_web`.
5. Buka `http://localhost/kasir_web/` pada browser.
6. Login menggunakan akun yang tersedia pada data database.

## Bukti UJK

- Unit 1: environment/terminal/IDE.
- Unit 2: `header.php`, `transaksi_tambah.php`, `barang_tambah.php`, `style.css`.
- Unit 3: fungsi validasi dan pengkondisian di `transaksi_simpan.php`, validasi JavaScript di `transaksi_tambah.php`.
- Unit 4: array of associative arrays dan `foreach` di `transaksi_tambah.php`.
- Unit 5: SweetAlert2 CDN di `header.php`, notifikasi di `footer.php` dan konfirmasi di `barang.php`.
- Unit 6: struktur file, penamaan, indentasi, dan pemisahan logic/layout/style.
- Unit 7: `try-catch`, `error_log`, `rollback`, dan `console.log`.
- Unit 8: komentar dokumentasi pada fungsi dan file ini sebagai README.
