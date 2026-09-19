<?php

require "koneksi.php";

$title = "Pelanggan";

require "header.php";

// Ambil data pelanggan
$q = $conn->query(
    "SELECT * FROM pelanggan ORDER BY id DESC"
);

?>

<div class="title">

    <div>
        <h1>Data Pelanggan</h1>
    </div>

    <a
        class="btn primary"
        href="pelanggan_tambah.php"
    >
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
            <th>Nama</th>
            <th>No HP</th>
            <th>Alamat</th>
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
                    <?= e($r["nama"]) ?>
                </td>

                <td>
                    <?= e($r["no_hp"]) ?>
                </td>

                <td>
                    <?= e($r["alamat"]) ?>
                </td>

                <td>

                    <a
                        class="btn small edit"
                        href="pelanggan_edit.php?id=<?= $r["id"] ?>"
                    >
                        Edit
                    </a>

                    <a
                        class="btn small delete"
                        href="pelanggan_hapus.php?id=<?= $r["id"] ?>"
                        onclick="return confirm('Hapus pelanggan?')"
                    >
                        Hapus
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    </table>

</div>


<?php require "footer.php"; ?>