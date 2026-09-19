<?php

session_start();

require "koneksi.php";

// Ambil data dari form login
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

// Cari user berdasarkan username
$s = $conn->prepare(
    "SELECT *
     FROM users
     WHERE username = ?
     LIMIT 1"
);

$s->bind_param("s", $username);
$s->execute();

$user = $s->get_result()->fetch_assoc();

// Verifikasi username dan password
if (
    $user &&
    password_verify($password, $user["password"])
) {
    // Regenerasi session ID untuk keamanan
    session_regenerate_id(true);

    $_SESSION["user_id"] = $user["id"];
    $_SESSION["nama"]    = $user["nama_lengkap"];
    $_SESSION["role"]    = $user["role"];

    // Login berhasil
    header("Location: dashboard.php");
    exit;
}

// Login gagal
$_SESSION["error"] = "Username atau password salah.";

header("Location: login.php");
exit;

?>