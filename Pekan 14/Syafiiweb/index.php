<?php
include 'koneksi.php';

$cari = "";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];

    $data = mysqli_query($conn,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'");
}else{
    $data = mysqli_query($conn,
    "SELECT * FROM mahasiswa");
}

$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html>
<head>

<title>Sistem Akademik Kampus</title>

<meta charset="utf-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f1ea;
    font-family:Segoe UI,sans-serif;
}

.navbar-custom{
    background:#1b1b1b;
    padding:15px 40px;
}

.logo-text{
    color:#d4af37;
    font-size:28px;
    font-weight:bold;
}

.hero{
    background:#d4af37;
    color:white;
    padding:50px;
    border-radius:20px;
    margin-top:30px;
    box-shadow:0 5px 20px rgba(0,0,0,.2);
}

.card-stat{
    border:none;
    border-radius:20px;
    padding:25px;
    color:white;
    transition:.3s;
}

.card-stat:hover{
    transform:translateY(-5px);
}

.gold{
    background:#d4af37;
}

.black{
    background:#1b1b1b;
}

.green{
    background:#2e7d32;
}

.main-box{
    background:white;
    border-radius:20px;
    padding:25px;
    margin-top:30px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.table th{
    background:#1b1b1b;
    color:white;
}

.admin-box{
    color:white;
    text-align:right;
}

.admin-box img{
    width:50px;
    height:50px;
    border-radius:50%;
    margin-left:10px;
}

.footer{
    text-align:center;
    margin-top:40px;
    color:#555;
}

</style>

</head>

<body>

<nav class="navbar navbar-custom">

<div class="container-fluid">

<span class="logo-text">
🎓 Sistem Akademik
</span>

<div class="admin-box">

<span>SYAFI'I</span>

<img src="https://i.imgur.com/6VBx3io.png">

</div>

</div>

</nav>

<div class="container">

<div class="hero">

<h1>
Selamat Datang
</h1>

<p>
Dashboard Sistem Informasi Mahasiswa
</p>

</div>

<div class="row mt-4">

<div class="col-md-4">

<div class="card-stat gold">

<h5>Total Mahasiswa</h5>

<h1><?php echo $total; ?></h1>

</div>

</div>

<div class="col-md-4">

<div class="card-stat black">

<h5>Status Sistem</h5>

<h1>Aktif</h1>

</div>

</div>

<div class="col-md-4">

<div class="card-stat green">

<h5>Portal Kampus</h5>

<h1>Online</h1>

</div>

</div>

</div>

<div class="main-box">

<div class="d-flex justify-content-between mb-4">

<h2>Data Mahasiswa</h2>

<a href="tambah.php"
class="btn btn-success">

<i class="bi bi-plus-circle"></i>

Tambah Data

</a>

</div>

<form method="GET" class="row mb-4">

<div class="col-md-10">

<input type="text"
name="cari"
class="form-control"
placeholder="Cari Nama Mahasiswa">

</div>

<div class="col-md-2">

<button class="btn btn-dark w-100">

Cari

</button>

</div>

</form>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<tr>

<th>No</th>
<th>Nama</th>
<th>NIM</th>
<th>Jurusan</th>
<th>Email</th>
<th>No HP</th>
<th>Aksi</th>

</tr>

<?php
$no = 1;

while($d = mysqli_fetch_array($data)){
?>

<tr>

<td><?= $no++; ?></td>
<td><?= $d['nama']; ?></td>
<td><?= $d['nim']; ?></td>
<td><?= $d['jurusan']; ?></td>
<td><?= $d['email']; ?></td>
<td><?= $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?= $d['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $d['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<div class="footer">

© 2026 Sistem Akademik Kampus - SYAFI'I

</div>

</div>

</body>
</html>