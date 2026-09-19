<?php

require "koneksi.php";

// Ambil data dari form
$id          = (int) $_POST["id"];
$kode_barang = $_POST["kode_barang"];
$nama_barang = $_POST["nama_barang"];
$harga       = $_POST["harga"];
$stok        = $_POST["stok"];

// Update data barang
$s = $conn->prepare(
    "UPDATE barang
     SET
        kode_barang = ?,
        nama_barang = ?,
        harga = ?,
        stok = ?
     WHERE id = ?"
);

$s->bind_param(
    "ssiii",
    $kode_barang,
    $nama_barang,
    $harga,
    $stok,
    $id
);

$s->execute();

// Kembali ke halaman data barang
header(
    "Location: barang.php?pesan=Barang berhasil diperbarui"
);

exit;
?>