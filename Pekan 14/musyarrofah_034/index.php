<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location:login.php");
}

include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>
<?php
session_start();

if(!isset($_SESSION['login'])){
    header("location:login.php");
}

include 'koneksi.php';

if(isset($_GET['cari'])){

    $cari = $_GET['cari'];

    $data = mysqli_query($koneksi,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'");

}else{

    $data = mysqli_query($koneksi,
    "SELECT * FROM mahasiswa");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Data Mahasiswa</h2>
<a href="logout.php">Logout</a>
<br><br>
<form method="GET">

    <input type="text" name="cari" placeholder="Cari nama...">

    <button type="submit">Cari</button>

</form>

<br>
<a href="tambah.php">+ Tambah Data</a>

<table border="1" cellpadding="10">

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

    <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a>

    <a href="hapus.php?id=<?php echo $d['id']; ?>"
    onclick="return confirm('Yakin ingin menghapus data?')">
    Hapus
    </a>

</td>

    </tr>

<?php
}
?>

</table>

</body>
</html>