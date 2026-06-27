<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");

// Set pesan sukses
$_SESSION['pesan'] = "Data mahasiswa berhasil dihapus!";
header("Location: index.php");
?>