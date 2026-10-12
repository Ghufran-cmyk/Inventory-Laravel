Multivision Gear - Inventory Management System

Aplikasi berbasis web untuk mengelola dan memantau stok peralatan fotografi secara real-time. Proyek ini dibangun menggunakan framework Laravel dengan mengimplementasikan arsitektur MVC (Model-View-Controller) secara penuh untuk memenuhi spesifikasi tugas pengembangan aplikasi web.

Fitur Utama

Manajemen Inventaris: Menampilkan daftar peralatan beserta harga, kode SKU, dan ketersediaan stok fisik.

Implementasi CRUD Lengkap:

Create: Menambahkan data peralatan inventaris baru ke dalam database.

Read: Menampilkan katalog peralatan dalam antarmuka yang terstruktur.

Update: Memperbarui rincian data peralatan yang sudah terdaftar.

Delete: Menghapus data peralatan dari sistem database.

Manajemen File Gambar: Mendukung pengunggahan foto produk, penyimpanan terstruktur menggunakan sistem symlink Laravel (storage link), serta fitur pembaruan foto yang dinamis.

Peringatan Stok Kritis: Indikator visual otomatis apabila stok barang berada pada batas minimum.

Antarmuka Kustom: Tampilan antarmuka pengguna (UI) dirancang secara mandiri menggunakan CSS native dan integrasi tipografi Plus Jakarta Sans.

Teknologi yang Digunakan

Framework: Laravel

Bahasa Pemrograman: PHP

Database: MySQL

Frontend: HTML5, CSS3, Laravel Blade Templating Engine

Panduan Instalasi Lokal

Berikut adalah langkah-langkah teknis untuk menjalankan proyek ini di lingkungan pengembangan lokal (localhost):

Clone repositori ini ke dalam direktori lokal Anda (misalnya di dalam folder htdocs):

git clone https://github.com/Ghufran-cmyk/Mini-Project-4-Inventory-Laravel.git


Masuk ke dalam direktori proyek:

cd Mini-Project-4-Inventory-Laravel


Instal seluruh dependensi proyek menggunakan Composer:

composer install


Konfigurasi Environment:
Salin file .env.example menjadi .env. Kemudian, buka file .env dan sesuaikan kredensial koneksi database Anda (pastikan Anda telah membuat database bernama inventory_db di MySQL):

DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=


Generate Application Key Laravel:

php artisan key:generate


Hubungkan direktori penyimpanan gambar (Pembuatan Symlink):

php artisan storage:link


Jalankan server pengembangan lokal:

php artisan serve


Akses aplikasi:
Buka web browser dan akses alamat http://127.0.0.1:8000.