<?php

require "koneksi.php";

// Ambil ID pelanggan
$id = (int) $_GET["id"];

// Hapus data pelanggan berdasarkan ID
$s = $conn->prepare(
    "DELETE FROM pelanggan WHERE id = ?"
);

$s->bind_param("i", $id);
$s->execute();

// Kembali ke halaman data pelanggan
header(
    "Location: pelanggan.php?pesan=Pelanggan berhasil dihapus"
);

exit;
?>