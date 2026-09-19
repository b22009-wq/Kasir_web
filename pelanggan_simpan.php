<?php

require "koneksi.php";

// Ambil data dari form
$nama   = $_POST["nama"];
$no_hp  = $_POST["no_hp"];
$alamat = $_POST["alamat"];

// Simpan data pelanggan
$s = $conn->prepare(
    "INSERT INTO pelanggan (
        nama,
        no_hp,
        alamat
    ) VALUES (?, ?, ?)"
);

$s->bind_param(
    "sss",
    $nama,
    $no_hp,
    $alamat
);

$s->execute();

// Kembali ke halaman data pelanggan
header(
    "Location: pelanggan.php?pesan=Pelanggan berhasil ditambahkan"
);

exit;
?>