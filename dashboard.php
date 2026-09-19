<?php

require "koneksi.php";

$title = "Dashboard";

require "header.php";

// Mengambil jumlah barang
$b = $conn
    ->query("SELECT COUNT(*) AS c FROM barang")
    ->fetch_assoc()["c"];

// Mengambil jumlah pelanggan
$p = $conn
    ->query("SELECT COUNT(*) AS c FROM pelanggan")
    ->fetch_assoc()["c"];

// Mengambil jumlah transaksi
$t = $conn
    ->query("SELECT COUNT(*) AS c FROM transaksi")
    ->fetch_assoc()["c"];

// Mengambil total penjualan
$r = $conn
    ->query(
        "SELECT COALESCE(SUM(total), 0) AS c FROM transaksi"
    )
    ->fetch_assoc()["c"];

?>

<div class="title">

    <div>
        <h1>Dashboard</h1>
        <p>Ringkasan sistem kasir.</p>
    </div>

</div>


<div class="stats">

    <!-- Total Barang -->
    <div>
        <span>📦</span>
        <h2><?= $b ?></h2>
        <p>Barang</p>
    </div>

    <!-- Total Pelanggan -->
    <div>
        <span>👥</span>
        <h2><?= $p ?></h2>
        <p>Pelanggan</p>
    </div>

    <!-- Total Transaksi -->
    <div>
        <span>🧾</span>
        <h2><?= $t ?></h2>
        <p>Transaksi</p>
    </div>

    <!-- Total Penjualan -->
    <div>
        <span>💰</span>
        <h2>
            Rp <?= number_format($r, 0, ",", ".") ?>
        </h2>
        <p>Penjualan</p>
    </div>

</div>


<div class="panel">

    <h2>Menu Cepat</h2>

    <div class="quick">

        <a href="barang.php">
            📦 Kelola Barang
        </a>

        <a href="pelanggan.php">
            👥 Kelola Pelanggan
        </a>

        <a href="transaksi_tambah.php">
            🧾 Transaksi Baru
        </a>

        <a href="laporan.php">
            📊 Laporan
        </a>

    </div>

</div>


<?php require "footer.php"; ?>