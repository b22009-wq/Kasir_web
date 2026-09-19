<?php

require "koneksi.php";

/**
 * Validasi input transaksi.
 *
 * @param int $barangId ID barang yang dipilih.
 * @param int $jumlah Jumlah barang yang dibeli.
 * @return void Melempar Exception jika input tidak valid.
 */
function validateTransactionInput(int $barangId, int $jumlah): void
{
    if ($barangId <= 0) {
        throw new Exception("Barang wajib dipilih.");
    }

    if ($jumlah < 1) {
        throw new Exception("Jumlah minimal 1 barang.");
    }
}

/**
 * Membuat kode transaksi unik berdasarkan waktu dan angka acak.
 *
 * @return string Kode transaksi.
 */
function createTransactionCode(): string
{
    return "TRX" . date("YmdHis") . rand(10, 99);
}


// ======================================================
// AMBIL DATA DARI FORM
// ======================================================

// Ambil data dari form dan ubah menjadi tipe data yang sesuai.
$barang_id = (int) ($_POST["barang_id"] ?? 0);
$jumlah = (int) ($_POST["jumlah"] ?? 0);

$pelanggan_id = ($_POST["pelanggan_id"] ?? "") === ""
    ? null
    : (int) $_POST["pelanggan_id"];


// ======================================================
// MULAI TRANSAKSI DATABASE
// ======================================================

// Semua proses akan berhasil atau dibatalkan bersama.
$conn->begin_transaction();

try {

    // ==================================================
    // VALIDASI INPUT
    // ==================================================

    // Unit 3: pemanggilan fungsi validasi terstruktur.
    validateTransactionInput($barang_id, $jumlah);


    // ==================================================
    // AMBIL DATA BARANG
    // ==================================================

    // Ambil data barang dan kunci baris selama transaksi.
    $s = $conn->prepare(
        "SELECT * FROM barang WHERE id = ? FOR UPDATE"
    );

    $s->bind_param("i", $barang_id);
    $s->execute();

    $barang = $s->get_result()->fetch_assoc();


    // ==================================================
    // CEK KETERSEDIAAN STOK
    // ==================================================

    // Cek ketersediaan barang menggunakan pengkondisian.
    if (!$barang || $barang["stok"] < $jumlah) {
        throw new Exception("Stok tidak mencukupi.");
    }


    // ==================================================
    // HITUNG TOTAL TRANSAKSI
    // ==================================================

    $total = $barang["harga"] * $jumlah;


    // ==================================================
    // BUAT KODE TRANSAKSI
    // ==================================================

    // Buat kode transaksi melalui fungsi khusus.
    $kode = createTransactionCode();


    // ==================================================
    // SIMPAN DATA TRANSAKSI
    // ==================================================

    $t = $conn->prepare(
        "INSERT INTO transaksi
        (kode_transaksi, pelanggan_id, total)
        VALUES (?, ?, ?)"
    );

    $t->bind_param(
        "sii",
        $kode,
        $pelanggan_id,
        $total
    );

    $t->execute();

    $transaksi_id = $conn->insert_id;


    // ==================================================
    // SIMPAN DETAIL TRANSAKSI
    // ==================================================

    $d = $conn->prepare(
        "INSERT INTO detail_transaksi
        (transaksi_id, barang_id, harga, jumlah, subtotal)
        VALUES (?, ?, ?, ?, ?)"
    );

    $d->bind_param(
        "iiiii",
        $transaksi_id,
        $barang_id,
        $barang["harga"],
        $jumlah,
        $total
    );

    $d->execute();


    // ==================================================
    // KURANGI STOK BARANG
    // ==================================================

    $u = $conn->prepare(
        "UPDATE barang
        SET stok = stok - ?
        WHERE id = ?"
    );

    $u->bind_param(
        "ii",
        $jumlah,
        $barang_id
    );

    $u->execute();


    // ==================================================
    // SIMPAN PERUBAHAN
    // ==================================================

    $conn->commit();

    header(
        "Location: transaksi.php?pesan=" .
        urlencode("Transaksi berhasil disimpan")
    );

} catch (Exception $e) {

    // ==================================================
    // ERROR HANDLING
    // ==================================================

    // Unit 7: debugging/error handling
    // dengan try-catch dan rollback.
    error_log(
        "Kasir Web error: " . $e->getMessage()
    );

    $conn->rollback();

    header(
        "Location: transaksi.php?pesan=" .
        urlencode($e->getMessage())
    );
}

exit;

?>