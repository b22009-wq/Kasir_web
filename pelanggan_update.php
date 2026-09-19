<?php

require "koneksi.php";

// Ambil data dari form
$id     = (int) $_POST["id"];
$nama   = $_POST["nama"];
$no_hp  = $_POST["no_hp"];
$alamat = $_POST["alamat"];

// Update data pelanggan
$s = $conn->prepare(
    "UPDATE pelanggan
     SET
        nama = ?,
        no_hp = ?,
        alamat = ?
     WHERE id = ?"
);

$s->bind_param(
    "sssi",
    $nama,
    $no_hp,
    $alamat,
    $id
);

$s->execute();

// Kembali ke halaman data pelanggan
header(
    "Location: pelanggan.php?pesan=Pelanggan berhasil diperbarui"
);

exit;
?>