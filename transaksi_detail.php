<?php

require "koneksi.php";

// Ambil ID transaksi
$id = (int) $_GET["id"];

// Ambil data transaksi dan pelanggan
$s = $conn->prepare(
    "SELECT
        t.*,
        COALESCE(p.nama, 'Umum') AS pelanggan
     FROM transaksi t
     LEFT JOIN pelanggan p
        ON p.id = t.pelanggan_id
     WHERE t.id = ?"
);

$s->bind_param("i", $id);
$s->execute();

$t = $s->get_result()->fetch_assoc();

// Jika transaksi tidak ditemukan
if (!$t) {
    header("Location: transaksi.php");
    exit;
}

// Ambil detail barang dalam transaksi
$d = $conn->prepare(
    "SELECT
        dt.*,
        b.nama_barang
     FROM detail_transaksi dt
     JOIN barang b
        ON b.id = dt.barang_id
     WHERE dt.transaksi_id = ?"
);

$d->bind_param("i", $id);
$d->execute();

$q = $d->get_result();

$title = "Detail Transaksi";

require "header.php";

?>

<div class="title">

    <div>
        <h1>Detail Transaksi</h1>

        <p>
            <?= e($t["kode_transaksi"]) ?>
            -
            <?= e($t["tanggal"]) ?>
        </p>
    </div>

    <a
        class="btn"
        href="transaksi.php"
    >
        Kembali
    </a>

</div>


<div class="panel">

    <p>
        <b>Pelanggan:</b>
        <?= e($t["pelanggan"]) ?>
    </p>


    <div class="table">

        <table>

            <tr>
                <th>Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>

            <?php while ($r = $q->fetch_assoc()): ?>

                <tr>

                    <td>
                        <?= e($r["nama_barang"]) ?>
                    </td>

                    <td>
                        Rp <?= number_format($r["harga"], 0, ",", ".") ?>
                    </td>

                    <td>
                        <?= e($r["jumlah"]) ?>
                    </td>

                    <td>
                        Rp <?= number_format($r["subtotal"], 0, ",", ".") ?>
                    </td>

                </tr>

            <?php endwhile; ?>


            <tr>

                <th colspan="3">
                    TOTAL
                </th>

                <th>
                    Rp <?= number_format($t["total"], 0, ",", ".") ?>
                </th>

            </tr>

        </table>

    </div>

</div>


<?php require "footer.php"; ?>