# penjualan_kendaraan

## panduan Instalasi

1.  Pastikan Local environment sudah terinstall PHP 8 dan mongodb 4
2.  Pastikan extension mongodb untuk php sudah terinstall jika belum download di `https://github.com/mongodb/mongo-php-driver/releases/tag/1.15.0` dan integrasikan dengan PHP
3.  pastikan juga extension tersebut sudah dipanggil di `php.ini` file
4.  Buat database baru di mongodb, saya pakai nama `db_penjualan_kendaraan`
5.  Clone project dari link `https://github.com/ronyelkahfi/penjualan_kendaraan.git`
6.  Pointing ke dalam folder project
7.  Run `composer install` lalu tunggu prosesnya sampai selesai
8.  Rename file `.env.example` menjadi `.env`
9.  Di dalam file `.env`ubah value `DB_DSN` sesuai konfigurasi mongodb local anda contoh konfigurasi saya `DB_DSN=mongodb://localhost:27017/`
10. Ubah value `DB_DATABASE` di file `.env` menjadi sesuai dengan nama database yang dibuat di point 4
11. Run `php artisan migrate` untuk migrasi collection ke mongodb local
12. Jika step 9 tidak bisa kemungkinan step 9 belum benar. Koreksi step 9
13. Run `php artisan serve` lalu akses ke `http://localhost:8000` jika muncul pesan `Instalasi Berhasil!` artinya konfigurasi sudah selesai

## panduan pengoperasion

Import file `Penjualan Kendaraan.postman_collection.json` ke dalam aplikasi postman. Gunakan Collection tersebut untuk test endpoint.
Penjelasan collection postman

1.  Endpoint `auth/register` digunakan untuk melakukan registrasi user. Setiap akses ke enpoint di project ini menggunakan Bearer token dalam bentuk JWT. Jadi harus register dulu lewat endpoint ini
2.  Endpoint `auth/login` digunakan untuk melakukan login. response dari endpoint ini berupa `access_token`, `type`, dan `expired time`
3.  Endpoint `Master kendaraan/Create`digunakan untuk membuat daftar kendaraan sebelum melakukan operasi penjualan
4.  Endpoint `Master Kendaraan/list kendaraan & Stok` digunakan untuk menampilkan daftar kendaraan yang sudah pernah didaftarkan. Di sini juga ditampilkan stok kendaraan
5.  Endpoint `Penjualan/create` untuk melakukan transaksi penjualan. Sebelum melakukan transaksi, dibutuhkan id kendaraan yang diambil ketika akses `Master Kendaraan/list kendaraan & Stok`
6.  Endpoint `Penjualan/Penjualan Berdasarkan Produk` adalah endpoint report penjualan kendaraan berdasarkan produk

## Struktur aplikasi

1. Default route berada di file `routes/api.php`
2. Controller berada di folder `app/http/controllers`
3. Services berada di folder `app/services`
4. Repository berada di folder `app/repositories`
5. Representasi class diagram berada di folder `app/services/dto`
6. Pola akses database antar collection berada di komunikasi antar service. Suatu service tidak bisa mengakses langsung repository service lain.
