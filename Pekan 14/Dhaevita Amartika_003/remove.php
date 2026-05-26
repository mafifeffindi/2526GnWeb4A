<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include 'koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
header("location:index.php");
?>