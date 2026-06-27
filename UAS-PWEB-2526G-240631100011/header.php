<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($judul_halaman) ? $judul_halaman . ' - ' : ''; ?>Sistem Pendataan Buku</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-brand">
            <span class="brand-icon">📚</span>
            <span>SiPuBuku</span>
        </a>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">🏠 Beranda</a></li>
            <li><a href="daftar.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'daftar.php') ? 'active' : ''; ?>">📋 Daftar Buku</a></li>
            <li><a href="tambah.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'tambah.php') ? 'active' : ''; ?>">➕ Tambah Buku</a></li>
        </ul>
    </div>
</nav>

<main class="main-content">
