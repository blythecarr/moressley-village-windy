<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Desa - Beranda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Beranda</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="profil.html">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="layanan.html">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="pendidikan.html">Pendidikan</a></li>
                <li class="nav-item"><a class="nav-link" href="galeri.html">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak.html">Kontak</a></li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="nav-link" href="dashboard.php">Dashboard Admin</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">Login Admin</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <header class="text-center">
        <h1>Selamat Datang di Desa Karanggambas</h1>
        <p>Mari mengenal lebih dekat desa kita yang asri dan berbudaya.</p>
    </header>

    <footer>
        <p>Hak Cipta Windy Pangestuti © 2024</p>
    </footer>
</body>
</html>
