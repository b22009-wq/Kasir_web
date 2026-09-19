<?php

require "koneksi.php";

$title = "Transaksi";

require "header.php";

// Ambil data transaksi dan nama pelanggan
$q = $conn->query(
    "SELECT
        t.*,
        COALESCE(p.nama, 'Umum') AS pelanggan
     FROM transaksi t
     LEFT JOIN pelanggan p
        ON p.id = t.pelanggan_id
     ORDER BY t.id DESC"
);

?>

<div class="title">

    <div>
        <h1>Transaksi Penjualan</h1>
    </div>

    <a
        class="btn primary"
        href="transaksi_tambah.php"
    >
        + Transaksi Baru
    </a>

</div>


<?php if (isset($_GET["pesan"])): ?>

    <div class="alert success">
        <?= e($_GET["pesan"]) ?>
    </div>

<?php endif; ?>


<div class="panel table">

    <table>

        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Detail</th>
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

                <td>

                    <a
                        class="btn small edit"
                        href="transaksi_detail.php?id=<?= $r["id"] ?>"
                    >
                        Lihat
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</div>


<?php require "footer.php"; ?>