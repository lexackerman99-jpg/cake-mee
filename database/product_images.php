<?php
/*
 * PEMETAAN FOTO PRODUK  ->  "nama produk|ukuran" => nama file di public/images/produk/
 *
 * Cara mengganti foto sebuah produk: ubah nama file di sebelah kanan, lalu jalankan
 *     php artisan migrate:fresh --seed        (hapus semua data, mulai dari awal)
 * atau, tanpa menghapus data, ubah langsung kolom `image` di tabel `products` lewat phpMyAdmin.
 * Produk yang tidak tercantum di sini otomatis memakai emoji.
 *
 * Foto yang belum terpakai: foto-03, 04, 11, 12, 14, 15, 19 (lihat folder public/images/produk).
 */
return [
    'Cake Coklat|28'                         => 'foto-07.jpg',
    'Cake Zebra|28'                          => 'foto-08.jpg',
    'Cake Sirikaya|28'                       => 'foto-13.jpg',   // tebakan (pandan)
    'Cake Pelangi|28'                        => 'foto-17.jpg',   // tebakan
    // 'Cake Ambekuk|28'                     => 'foto-12.jpg',   // belum yakin
    // 'Cake Orson (sirup ABC)|28'           => 'foto-19.jpg',   // belum yakin

    'Cake Kecil|18'                          => 'foto-01.jpg',   // tebakan

    'Cake Mix|20'                            => 'foto-02.jpg',   // tebakan
    'Cake Mix|24'                            => 'foto-02.jpg',
    'Cake Keju|20'                           => 'foto-16.jpg',
    'Cake Keju|24'                           => 'foto-16.jpg',

    'Cake Coklat Topping Full Coklat|20'     => 'foto-05.jpg',
    'Cake Coklat Topping Full Coklat|16'     => 'foto-05.jpg',
    'Cake Coklat Topping Coklat Keju|20'     => 'foto-10.jpg',
    'Cake Coklat Topping Coklat Keju|16'     => 'foto-18.jpg',
    'Cake Coklat Topping Kenari|20'          => 'foto-06.jpg',
    'Cake Coklat Topping Kenari|16'          => 'foto-06.jpg',
];
