<?php

require "koneksi.php";

$title = "Data Barang";

require "header.php";

// Ambil semua data barang
$q = $conn->query(
    "SELECT * FROM barang ORDER BY id DESC"
);

?>

<div class="title">

    <div>
        <h1>Data Barang</h1>
        <p>CRUD data barang dan stok.</p>
    </div>

    <a class="btn primary" href="barang_tambah.php">
        + Tambah
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
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
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
                    <?= e($r["kode_barang"]) ?>
                </td>

                <td>
                    <?= e($r["nama_barang"]) ?>
                </td>

                <td>
                    Rp <?= number_format($r["harga"], 0, ",", ".") ?>
                </td>

                <td>
                    <?= e($r["stok"]) ?>
                </td>

                <td>

                    <a
                        class="btn small edit"
                        href="barang_edit.php?id=<?= $r["id"] ?>"
                    >
                        Edit
                    </a>

                    <a
                        class="btn small delete"
                        href="barang_hapus.php?id=<?= $r["id"] ?>"
                        onclick="return konfirmasiHapus(event, this)"
                    >
                        Hapus
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</div>


<script>
// Konfirmasi penghapusan menggunakan SweetAlert2.
function konfirmasiHapus(event, link) {
    event.preventDefault();
    Swal.fire({
        title: 'Hapus barang?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) window.location.href = link.href;
    });
    return false;
}
</script>
<?php require "footer.php"; ?>