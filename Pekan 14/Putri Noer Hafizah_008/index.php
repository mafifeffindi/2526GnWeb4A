<?php
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Sistem Data Mahasiswa</span>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-4">
<div class="card shadow">
<div class="card-body">

<h3 class="text-center mb-3 text-primary">Data Mahasiswa</h3>

<div class="d-flex justify-content-between mb-3">
    <a href="tambah.php" class="btn btn-primary">+ Tambah Data</a>

    <form method="GET" class="d-flex">
        <input class="form-control me-2" type="text" name="cari" placeholder="Cari...">
        <button class="btn btn-success">Cari</button>
    </form>
</div>

<table class="table table-bordered table-striped text-center">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Prodi</th>
    <th>Email</th>
    <th>No HP</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php
$no = 1;

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa 
        WHERE nama LIKE '%$cari%' 
        OR nim LIKE '%$cari%' 
        OR prodi LIKE '%$cari%'");
} else {
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa");
}

while ($d = mysqli_fetch_array($data)) {
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nim']; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['prodi']; ?></td>
    <td><?= $d['email']; ?></td>
    <td><?= $d['no_hp']; ?></td>
    <td>
        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>

<?php } ?>
</tbody>

</table>

</div>
</div>
</div>

</body>
</html>
