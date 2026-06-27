<?php
$host     = "localhost";
$user     = "root";
$password = ""; // Kosongkan jika pakai XAMPP bawaan
$database = "db_mahasiswa"; // Pastikan namanya sama persis dengan yang di phpMyAdmin

// Proses koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);
// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>