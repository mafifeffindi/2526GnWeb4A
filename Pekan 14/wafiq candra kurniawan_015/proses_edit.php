<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id    = $_POST['id'];
$nama  = $_POST['nama'];
$nim   = $_POST['nim'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', nim='$nim', email='$email', no_hp='$no_hp' WHERE id='$id'");

// Set pesan sukses
$_SESSION['pesan'] = "Data mahasiswa berhasil diperbarui!";
header("Location: index.php");
?>