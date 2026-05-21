<?php

$koneksi = mysqli_connect("localhost", "root", "", "kampus_utm");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>