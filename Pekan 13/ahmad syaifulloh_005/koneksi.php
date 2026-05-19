<?php 
$koneksi=mysqli_connect("localhost", "root", "", "db_kampus");

if(!$koneksi) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>