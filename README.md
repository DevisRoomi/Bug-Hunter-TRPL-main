
Laporan Tugas Bug Hunter - Kelas TRPL

Tanggal: 9 - 11 September 2026

Materi: Debugging dan Troubleshooting Project Laravel

Studi Kasus: Aplikasi "Rental Gear"

Dokumen ini berisi laporan langkah-langkah pencarian dan perbaikan bug (Bug Hunting) pada proyek Laravel yang diberikan oleh mentor. Berikut adalah dokumentasi error yang ditemukan beserta solusinya.

1. Instalasi Dependensi (Missing Vendor)

Masalah: Proyek Laravel tidak bisa dijalankan karena tidak ada folder vendor. Laravel tanpa dependensi (vendor) tidak akan berfungsi.
Solusi:
Menjalankan perintah Composer untuk mengunduh semua dependensi yang dibutuhkan proyek.

composer install
composer update


2. Setup Environment & Generate APP_KEY

Masalah: Aplikasi mengalami error karena file .env dan APP_KEY belum dikonfigurasi. APP_KEY berfungsi sebagai kunci kriptografi utama untuk menjaga keamanan data sensitif aplikasi; tanpa ini, sistem pertahanan Laravel tidak akan berjalan.
Solusi:

Salin file .env.example dan ubah namanya menjadi .env.

Hasilkan (generate) APP_KEY baru dengan menjalankan perintah:

php artisan key:generate


3. Akses Database Ditolak (Access Denied)

Masalah: Muncul error SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'. Hal ini terjadi karena konfigurasi koneksi database di .env masih di-comment atau kosong kata sandinya.
Solusi:

Buka file .env, hilangkan tanda komentar (uncomment), dan sesuaikan kredensial database (isi password jika ada):

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=


Jalankan migrasi tabel database dan jalankan server lokal:

php artisan migrate
php artisan serve


4. Error Route Not Defined

Masalah: Muncul error Route [borrowings.index] not defined pada browser.
Solusi:
Dengan melihat Exception trace di browser, petunjuk mengarah ke file resources/views/borrowings/layouts/app.blade.php. Terdapat typo pada pemanggilan nama route. Variabel yang seharusnya ditulis borrowing (tanpa 's') tertulis borrowings. Menghapus huruf 's' menyelesaikan masalah ini.

5. Daftar Perlengkapan Kosong (Empty Equipment List)

Masalah: Halaman berhasil tampil, namun daftar perlengkapan (seperti backpack, dll) kosong.
Solusi:
Laravel menyimpan data awal/dummy di database/seeders/ dan database/factories/. Untuk memunculkan data awal aplikasi, kita perlu menjalankan seeder (biasanya disertakan saat migrate: php artisan migrate --seed atau php artisan db:seed).

6. Gambar Perlengkapan Tidak Muncul

Masalah: Gambar produk "Power Bank" tidak muncul di halaman utama.
Solusi:
Mengecek direktori public/images/. Ternyata nama file gambar yang ada di folder public tidak sama dengan nama file yang dideklarasikan di dalam file seeder (database/seeders/). Nama gambar di folder public/images/ di-rename disesuaikan menjadi power-bank-missing.jpg agar terbaca oleh sistem.

7. ParseError (Syntax Error) pada Blade

Masalah: Saat mengklik tombol "Pinjam Alat", muncul pesan error ParseError: syntax error, unexpected token "{" di resources\views\borrowings\create.blade.php:16.
Solusi:
Mengikuti petunjuk baris error dari Exception trace di pojok kanan atas browser. Ditemukan ada kelebihan kurung kurawal {{ yang tidak valid pada baris 16 file create.blade.php. Menghapus kurung kurawal yang berlebih tersebut memperbaiki halaman.

8. Mengubah Nama Aplikasi (Configuration Cache)

Masalah: Nama aplikasi pada landing page masih menggunakan nama bawaan "Laravel".
Solusi:
Sesuai instruksi mentor, nama aplikasi diubah menjadi "Rental Gear".

Buka file .env dan ubah variabel APP_NAME di baris paling atas:

APP_NAME="Rental Gear"


(Catatan: Gunakan tanda kutip karena terdapat spasi pada nama).

Kesimpulan:
Proses bug hunting ini mengajarkan pentingnya membaca pesan error (terutama Exception trace di browser) yang sudah memberikan petunjuk letak file dan baris yang bermasalah. Selain itu, pemahaman dasar tentang arsitektur Laravel seperti .env, composer, routing, dan seeders sangat krusial untuk memperbaiki aplikasi.
