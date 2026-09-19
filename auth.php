<?php

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Fungsi untuk mengamankan output HTML
function e($v)
{
    return htmlspecialchars(
        (string) $v,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>