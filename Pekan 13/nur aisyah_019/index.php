<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location:login.php");
}
?>

<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div style="max-width:800px; margin:auto;">

<div style="display:flex; justify-content:space-between; align-items:center;">
    <h2>Data Mahasiswa</h2>
    <a href="logout.php">Logout</a>
</div>

<br>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="cari" placeholder="Cari nama...">
    <button type="submit">Cari</button>
</form>

<br>

<a href="tambah.php">+ Tambah Data</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%".$cari."%'");
    } else {
        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
    }

    while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td><?php echo $d['email']; ?></td>
        <td><?php echo $d['no_hp']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a> |
            <a href="hapus.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

</div>

</body>
</html>