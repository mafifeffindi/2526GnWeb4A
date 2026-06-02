<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "db_kampus");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
