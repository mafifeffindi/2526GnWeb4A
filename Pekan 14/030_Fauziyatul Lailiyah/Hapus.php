<?php

session_start();

include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($koneksi,
"DELETE FROM mahasiswa WHERE id='$id'");

if($hapus){

    $_SESSION['notif'] = "Data berhasil dihapus!";

}else{

    $_SESSION['notif'] = "Data gagal dihapus!";

}

header("location:index.php");

?>
