<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
    exit;
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">

<a href="index.php">Dashboard</a>
<a href="tambah.php">Tambah Data</a>
<a href="logout.php">Logout</a>

</div>

<div class="container">

<h2>DATA MAHASISWA</h2>

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>NIM</th>
<th>Jurusan</th>
<th>Email</th>
<th>No HP</th>
<th>Aksi</th>
</tr>

<?php

$data = mysqli_query($conn,
"SELECT * FROM mahasiswa");

while($d=mysqli_fetch_array($data)){
?>

<tr>

<td><?= $d['id']; ?></td>
<td><?= $d['nama']; ?></td>
<td><?= $d['nim']; ?></td>
<td><?= $d['jurusan']; ?></td>
<td><?= $d['email']; ?></td>
<td><?= $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?= $d['id']; ?>">
Edit
</a>

|

<a href="hapus.php?id=<?= $d['id']; ?>"
onclick="return confirm('Yakin Hapus?')">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>