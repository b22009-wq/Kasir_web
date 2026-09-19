<?php

require "koneksi.php";

// Ambil ID barang
$id = (int) $_GET["id"];

// Hapus data barang berdasarkan ID
$s = $conn->prepare(
    "DELETE FROM barang WHERE id = ?"
);

$s->bind_param("i", $id);
$s->execute();

// Kembali ke halaman data barang
header(
    "Location: barang.php?pesan=Barang berhasil dihapus"
);

exit;
?>