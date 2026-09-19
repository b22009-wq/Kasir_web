<?php

session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

// Ambil pesan error
$error = $_SESSION["error"] ?? "";

unset($_SESSION["error"]);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Kasir</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body class="login">

    <div class="loginbox">

        <div class="logo">
            🛒
        </div>

        <h1>
            Kasir Web
        </h1>

        <p>
            Silakan login ke sistem
        </p>


        <?php if ($error): ?>

            <div class="alert danger">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form
            method="post"
            action="proses_login.php"
        >

            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Masukkan username"
                required
            >


            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >


            <button
                type="submit"
                class="btn primary full"
            >
                Login
            </button>

        </form>

    </div>

</body>

</html>