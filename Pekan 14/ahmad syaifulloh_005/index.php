<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location:login.php");
}

include 'koneksi.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$data = mysqli_query($koneksi,
"SELECT * FROM mahasiswa
WHERE nama LIKE '%$cari%'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Data Mahasiswa</h2>

<a href="tambah.php">+ Tambah Data</a>
<a href="logout.php">Logout</a>

<br><br>

<form method="GET">

<input type="text"
name="cari"
placeholder="Cari Nama">

<button type="submit">
Cari
</button>

</form>

<br>

<table>

<tr>
<th>No</th>
<th>NIM</th>
<th>Nama</th>
<th>Prodi</th>
<th>Email</th>
<th>No HP</th>
<th>Aksi</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_array($data)){
?>

<tr>

<td><?php echo $no++; ?></td>
<td><?php echo $d['nim']; ?></td>
<td><?php echo $d['nama']; ?></td>
<td><?php echo $d['prodi']; ?></td>
<td><?php echo $d['email']; ?></td>
<td><?php echo $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?php echo $d['id']; ?>">
Edit
</a>

<a href="hapus.php?id=<?php echo $d['id']; ?>"
onclick="return confirm('Yakin hapus data?')">

Hapus

</a>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>