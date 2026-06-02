<?php
include 'koneksi.php';

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

<title>Dashboard Kampus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

background:
linear-gradient(
135deg,
#0f2027,
#203a43,
#2c5364
);

min-height: 100vh;

font-family: Arial;

overflow-x: hidden;

}

.sidebar{

width: 250px;

height: 100vh;

background:
rgba(0,0,0,0.4);

position: fixed;

padding: 20px;

backdrop-filter: blur(10px);

}

.sidebar h3{

color: white;

text-align: center;

margin-bottom: 40px;

font-weight: bold;

}

.sidebar a{

display: block;

color: white;

padding: 14px;

margin-bottom: 12px;

text-decoration: none;

border-radius: 12px;

transition: 0.3s;

font-size: 16px;

}

.sidebar a:hover{

background: #0d6efd;

transform: translateX(5px);

}

.content{

margin-left: 270px;

padding: 30px;

}

.welcome{

background:
linear-gradient(
45deg,
#4776E6,
#8E54E9
);

padding: 30px;

border-radius: 20px;

color: white;

margin-bottom: 30px;

box-shadow: 0 0 20px rgba(0,0,0,0.3);

}

.card-box{

border-radius: 20px;

padding: 25px;

color: white;

transition: 0.3s;

box-shadow: 0 0 20px rgba(0,0,0,0.2);

}

.card-box:hover{

transform: translateY(-5px);

}

.bg1{

background:
linear-gradient(
45deg,
#ff512f,
#dd2476
);

}

.bg2{

background:
linear-gradient(
45deg,
#11998e,
#38ef7d
);

}

.bg3{

background:
linear-gradient(
45deg,
#396afc,
#2948ff
);

}

.main-card{

background: rgba(255,255,255,0.95);

border-radius: 20px;

padding: 20px;

backdrop-filter: blur(10px);

box-shadow: 0 0 20px rgba(0,0,0,0.2);

}

.table{

border-radius: 10px;

overflow: hidden;

}

.table-hover tbody tr:hover{

background: #f3f3f3;

transition: 0.3s;

}

.btn{

border-radius: 10px;

}

input{

border-radius: 10px !important;

}

.profile{

text-align: center;

margin-top: 30px;

color: white;

}

.profile img{

width: 90px;

height: 90px;

border-radius: 50%;

object-fit: cover;

border: 3px solid white;

margin-bottom: 10px;

}

.clock{

font-size: 18px;

font-weight: bold;

margin-top: 10px;

}

</style>

</head>

<body>

<div class="sidebar">

<h3>

<i class="bi bi-mortarboard-fill"></i>

Admin Kampus

</h3>

<a href="index.php">

<i class="bi bi-speedometer2"></i>

Dashboard

</a>

<a href="#data">

<i class="bi bi-people-fill"></i>

Mahasiswa

</a>

<a href="profil.php">

<i class="bi bi-person-circle"></i>

Profile

</a>

<a href="logout.php">

<i class="bi bi-box-arrow-right"></i>

Logout

</a>

<div class="profile">

<img src="https://i.imgur.com/6VBx3io.png">

<h5>Siti Lutfia Wardani</h5>

<div class="clock" id="jam"></div>

</div>

</div>

<div class="content">

<div class="welcome">

<h2>
Selamat Datang di Dashboard Kampus
</h2>

<p>
Sistem Informasi Data Mahasiswa
</p>

</div>

<div class="row mb-4">

<div class="col-md-4">

<div class="card-box bg1">

<h5>

<i class="bi bi-people-fill"></i>

Total Mahasiswa

</h5>

<h1>

<?php echo $total; ?>

</h1>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg2">

<h5>

<i class="bi bi-database-fill"></i>

Sistem Akademik

</h5>

<h1>Aktif</h1>

</div>

</div>

<div class="col-md-4">

<div class="card-box bg3">

<h5>

<i class="bi bi-wifi"></i>

Portal Kampus

</h5>

<h1>Online</h1>

</div>

</div>

</div>

<div class="main-card" id="data">

<h2 class="text-center mb-4">

Data Mahasiswa

</h2>

<div class="d-flex justify-content-between mb-4">

<a href="tambah.php"
class="btn btn-primary">

<i class="bi bi-plus-circle"></i>

Tambah Data

</a>

<form method="GET" class="d-flex">

<input type="text"
name="cari"
class="form-control me-2"
placeholder="Cari Mahasiswa">

<button type="submit"
class="btn btn-success">

<i class="bi bi-search"></i>

</button>

</form>

</div>

<table class="table table-bordered table-hover">

<tr class="table-dark text-center">

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

<td><?php echo $no++; ?></td>

<td><?php echo $d['nama']; ?></td>

<td><?php echo $d['nim']; ?></td>

<td><?php echo $d['jurusan']; ?></td>

<td><?php echo $d['email']; ?></td>

<td><?php echo $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?php echo $d["id"]; ?>"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

</a>

<a href="hapus.php?id=<?php echo $d["id"]; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">

<i class="bi bi-trash-fill"></i>

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<script>

function updateJam(){

const sekarang = new Date();

document.getElementById("jam").innerHTML =
sekarang.toLocaleTimeString();

}

setInterval(updateJam,1000);

updateJam();

</script>

</body>
</html>