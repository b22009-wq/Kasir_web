<?php

require "koneksi.php";

// Ambil data dari form
$kode_barang = $_POST["kode_barang"];
$nama_barang = $_POST["nama_barang"];
$harga       = $_POST["harga"];
$stok        = $_POST["stok"];

// Simpan data barang
$s = $conn->prepare(
    "INSERT INTO barang (
        kode_barang,
        nama_barang,
        harga,
        stok
    ) VALUES (?, ?, ?, ?)"
);

$s->bind_param(
    "ssii",
    $kode_barang,
    $nama_barang,
    $harga,
    $stok
);

$s->execute();

// Kembali ke halaman data barang
header(
    "Location: barang.php?pesan=Barang berhasil ditambahkan"
);

exit;
?>