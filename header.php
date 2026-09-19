<?php
require_once "auth.php";
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($title ?? "Kasir Web") ?></title>

    <link rel="stylesheet" href="style.css">

    <!-- Library eksternal: SweetAlert2 via CDN (UJK Unit 5) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <header class="top">
        <div>
            <b>🛒 Kasir Web</b>
            <small>Sistem Informasi Penjualan</small>
        </div>

        <div>
            <?= e($_SESSION["nama"]) ?>
            (<?= e($_SESSION["role"]) ?>)

            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="layout">

        <aside>
            <a href="dashboard.php">🏠 Dashboard</a>
            <a href="barang.php">📦 Data Barang</a>
            <a href="pelanggan.php">👥 Pelanggan</a>
            <a href="transaksi.php">🧾 Transaksi</a>
            <a href="laporan.php">📊 Laporan</a>
        </aside>

        <main>