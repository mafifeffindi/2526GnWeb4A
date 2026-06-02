<?php
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");

header("location:index.php");
?>
