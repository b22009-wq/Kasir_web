<?php

require "koneksi.php";

$title = "Laporan";

require "header.php";

// Ambil data transaksi dan pelanggan
$q = $conn->query(
    "SELECT
        t.*,
        COALESCE(p.nama, 'Umum') AS pelanggan
     FROM transaksi t
     LEFT JOIN pelanggan p
        ON p.id = t.pelanggan_id
     ORDER BY t.tanggal DESC"
);

// Hitung total seluruh penjualan
$total = $conn
    ->query(
        "SELECT COALESCE(SUM(total), 0) AS c
         FROM transaksi"
    )
    ->fetch_assoc()["c"];

?>

<div class="title">

    <div>
        <h1>Laporan Penjualan</h1>
    </div>

</div>


<!-- Total Penjualan -->
<div class="panel">

    <h3>
        Total Penjualan:
        Rp <?= number_format($total, 0, ",", ".") ?>
    </h3>

</div>


<!-- Tabel Laporan -->
<div class="panel table">

    <table>

        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
        </tr>

        <?php
        $n = 1;

        while ($r = $q->fetch_assoc()):
        ?>

            <tr>

                <td>
                    <?= $n++ ?>
                </td>

                <td>
                    <?= e($r["kode_transaksi"]) ?>
                </td>

                <td>
                    <?= e($r["tanggal"]) ?>
                </td>

                <td>
                    <?= e($r["pelanggan"]) ?>
                </td>

                <td>
                    Rp <?= number_format($r["total"], 0, ",", ".") ?>
                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</div>


<?php require "footer.php"; ?>