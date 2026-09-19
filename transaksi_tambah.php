<?php

require "koneksi.php";

$title = "Transaksi Baru";
require "header.php";

// Unit 4: struktur data berupa array of associative arrays.
$barangList = [];
$b = $conn->query(
    "SELECT * FROM barang WHERE stok > 0 ORDER BY nama_barang"
);
while ($barang = $b->fetch_assoc()) {
    $barangList[] = $barang;
}

$pelangganList = [];
$p = $conn->query(
    "SELECT * FROM pelanggan ORDER BY nama"
);
while ($pelanggan = $p->fetch_assoc()) {
    $pelangganList[] = $pelanggan;
}

?>

<div class="title"><div><h1>Transaksi Penjualan</h1></div></div>

<div class="panel form">
<form method="post" action="transaksi_simpan.php" id="transaksiForm">
    <!-- Pilihan Pelanggan -->
    <label for="pelanggan_id">Pelanggan</label>
    <select id="pelanggan_id" name="pelanggan_id">
        <option value="">Umum</option>
        <?php foreach ($pelangganList as $pelanggan): ?>
            <option value="<?= e($pelanggan["id"]) ?>">
                <?= e($pelanggan["nama"]) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Pilihan Barang -->
    <label for="barang_id">Barang</label>
    <select id="barang_id" name="barang_id" required>
        <option value="">-- Pilih barang --</option>
        <?php foreach ($barangList as $barang): ?>
            <option value="<?= e($barang["id"]) ?>">
                <?= e($barang["nama_barang"]) ?> - Rp <?= number_format($barang["harga"], 0, ",", ".") ?> (stok <?= e($barang["stok"]) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Jumlah Barang -->
    <label for="jumlah">Jumlah</label>
    <input type="number" id="jumlah" name="jumlah" min="1" required>

    <div class="actions">
        <a class="btn" href="transaksi.php">Batal</a>
        <button type="submit" class="btn primary">Simpan Transaksi</button>
    </div>
</form>
</div>

<script>
// Unit 3 & 7: validasi client-side dan debugging sederhana.
document.getElementById('transaksiForm').addEventListener('submit', function (event) {
    const barangId = document.getElementById('barang_id').value;
    const jumlah = Number(document.getElementById('jumlah').value);
    console.log('[DEBUG] transaksi submit', { barangId, jumlah });

    if (!barangId || jumlah < 1) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Data belum lengkap',
            text: 'Pilih barang dan masukkan jumlah minimal 1.'
        });
    }
});
</script>

<?php require "footer.php"; ?>