<?php
// koneksi.php - File koneksi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_buku');

$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$koneksi) {
    die("<div style='text-align:center;padding:50px;font-family:sans-serif;'>
        <h2 style='color:red;'>❌ Koneksi Database Gagal</h2>
        <p>" . mysqli_connect_error() . "</p>
        <p>Pastikan MySQL berjalan dan database <strong>db_buku</strong> sudah dibuat.</p>
    </div>");
}

mysqli_set_charset($koneksi, 'utf8mb4');
?>
