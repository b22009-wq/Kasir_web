<?php

require "koneksi.php";

// Ambil ID barang
$id = (int) $_GET["id"];

// Ambil data barang berdasarkan ID
$s = $conn->prepare(
    "SELECT * FROM barang WHERE id = ?"
);

$s->bind_param("i", $id);
$s->execute();

$r = $s->get_result()->fetch_assoc();

// Jika data tidak ditemukan
if (!$r) {
    header("Location: barang.php");
    exit;
}

$title = "Edit Barang";

require "header.php";

?>

<div class="title">
    <h1>Edit Barang</h1>
</div>

<div class="panel form">

    <form method="post" action="barang_update.php">

        <input
            type="hidden"
            name="id"
            value="<?= e($r["id"]) ?>"
        >

        <label for="kode_barang">
            Kode Barang
        </label>

        <input
            type="text"
            id="kode_barang"
            name="kode_barang"
            value="<?= e($r["kode_barang"]) ?>"
            required
        >


        <label for="nama_barang">
            Nama Barang
        </label>

        <input
            type="text"
            id="nama_barang"
            name="nama_barang"
            value="<?= e($r["nama_barang"]) ?>"
            required
        >


        <label for="harga">
            Harga
        </label>

        <input
            type="number"
            id="harga"
            name="harga"
            value="<?= e($r["harga"]) ?>"
            min="0"
            required
        >


        <label for="stok">
            Stok
        </label>

        <input
            type="number"
            id="stok"
            name="stok"
            value="<?= e($r["stok"]) ?>"
            min="0"
            required
        >


        <div class="actions">

            <a
                class="btn"
                href="barang.php"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn primary"
            >
                Update
            </button>

        </div>

    </form>

</div>


<?php require "footer.php"; ?>