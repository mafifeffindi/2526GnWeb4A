<?php
// ============================================================
// koneksi.php — Database Connection
// Sistem Catatan Keuangan Sederhana "Dompetku"
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dompetku');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die('<div style="font-family:sans-serif;padding:40px;background:#1A1A22;color:#FF6B6B;border-left:4px solid #FF6B6B;margin:40px;">
        <strong>Koneksi database gagal.</strong><br>
        Pastikan XAMPP sudah berjalan dan database <em>dompetku</em> sudah diimport.<br><br>
        Error: ' . htmlspecialchars($conn->connect_error) . '
    </div>');
}

$conn->set_charset('utf8mb4');
?>
