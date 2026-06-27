<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$nama  = $_POST['nama'];
$nim   = $_POST['nim'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

mysqli_query($koneksi, "INSERT INTO mahasiswa (nama, nim, email, no_hp) VALUES ('$nama', '$nim', '$email', '$no_hp')");

// Set pesan sukses
$_SESSION['pesan'] = "Data mahasiswa berhasil ditambahkan!";
header("Location: index.php");
?>