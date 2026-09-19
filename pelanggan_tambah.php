<?php

$title = "Tambah Pelanggan";

require "header.php";

?>

<div class="title">
    <h1>Tambah Pelanggan</h1>
</div>


<div class="panel form">

    <form
        method="post"
        action="pelanggan_simpan.php"
    >

        <label for="nama">
            Nama
        </label>

        <input
            type="text"
            id="nama"
            name="nama"
            required
        >


        <label for="no_hp">
            No. HP
        </label>

        <input
            type="text"
            id="no_hp"
            name="no_hp"
        >


        <label for="alamat">
            Alamat
        </label>

        <textarea
            id="alamat"
            name="alamat"
        ></textarea>


        <div class="actions">

            <a
                class="btn"
                href="pelanggan.php"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn primary"
            >
                Simpan
            </button>

        </div>

    </form>

</div>


<?php require "footer.php"; ?>