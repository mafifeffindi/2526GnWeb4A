<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud-php"; // Sesuaikan nama database-mu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>