<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$koneksi = mysqli_connect("localhost", "root", "", "db_tugas_pekan14");

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
