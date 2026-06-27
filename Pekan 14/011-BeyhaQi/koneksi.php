<?php
// Sesuaikan dengan settingan XAMPP bawaan kamu
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_kampus";

$koneksi = mysqli_connect($host, $username, $password, $database);

// CEK KONEKSI: Jika gagal, langsung matikan halaman dan munculkan error-nya
if (!$koneksi) {
    die("Koneksi ke database GAGAL karena: " . mysqli_connect_error());
}
?>