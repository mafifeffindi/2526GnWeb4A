<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $delete = mysqli_query($koneksi, "DELETE FROM nama_tabelmu WHERE id = '$id'");
    
    if ($delete) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location='index.php';</script>";
    }
}
?>