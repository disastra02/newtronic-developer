<a id="readme-top"></a>

## PHP Developer

### Teknologi
- Framework: Laravel 10 (PHP 8.1)
- Database: MySQL
- WebSocket: Laravel Websockets

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal aplikasi ini.

1. Clone Repository
```sh
git clone https://github.com/disastra02/newtronic-developer.git
```
2. Install Dependensi
```sh
composer install
```
3. Konfigurasi
Salin file .env.example menjadi .env dan konfigurasi database sesuai dengan konfigurasi dilaptop:
```sh
cp .env.example .env
php artisan key:generate
```
4. Migrasi dan Seeder
Jalankan migrasi database dan seeder untuk data awal (user dan produk):
```sh
php artisan migrate --seed
```
5. Jalankan Aplikasi
```sh
php artisan serve --host=0.0.0.0
```
6. Jalankan WebSocket (Perlu dijalankan, untuk studi kasus #3) 
```sh
php artisan websockets:serve --host=0.0.0.0
```
7. Akses Aplikasi 
```sh
http://localhost:8000
```

## Menjalankan Aplikasi

Pastikan langkah-langkah diatas telah berhasil terinstal, setelah itu berikut panduan singkat untuk penggunaan aplikasi:

### Studi Kasus #1

Ada beberapa user yang dapat digunakan:
- Email: admin@gmail.com | Password: 12345678 (User untuk menambahkan produk dan bisa melakukan transaksi)
- Email: user1@gmail.com | Password: 12345678 (User untuk melakukan transaksi)
- Email: user2@gmail.com | Password: 12345678 (User untuk melakukan transaksi)

Setelah login maka dapat digunakan untuk menambah produk ataupun melakukan transaksi.

### Studi Kasus #2

Untuk pertama kali yaitu dengan klik tombol "Crawl Data" kemudian akan otomatis meng crwal data yang ada di dalam tabel kurs. Jika sudah melakukannya maka nanti akan tampil link atau tombol untuk melihat hasilnya dalam bentuk JSON.

### Studi Kasus #3

Ada dua tampilan: 
- Tampilan papan skor, jika data ada maka akan tampil papan skor sesuai dengan jenis olahraga (Sepak Bola, Basket, Voli).
- Tampilan operator, untuk memasukkan data skor dari jenis olahraga yang dipilih.

Setelah operator memasukkan data skor, maka data tersebut akan masuk kedalam database.

README ini dirancang agar pengguna baru dapat memahami aplikasi ini. Terimakasih

<p align="right">(<a href="#readme-top">back to top</a>)</p>