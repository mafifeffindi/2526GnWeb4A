<?php
include 'koneksi.php';
session_start(); // Memastikan session aktif jika ingin memproteksi halaman

// Mengamankan parameter ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Mengambil data untuk ditampilkan di form
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
if(isset($_POST['update'])){
    $nim    = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi  = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $email  = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp  = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    mysqli_query($koneksi,
    "UPDATE mahasiswa SET
    nim='$nim',
    nama='$nama',
    prodi='$prodi',
    email='$email',
    no_hp='$no_hp'
    WHERE id='$id'");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Data</title> 
</head> 
<body>

<h2>Edit Data Mahasiswa</h2>

<form method="post"> 
    <input type="text" name="nim" 
    value="<?php echo $d['nim']; ?>"><br><br>

    <input type="text" name="nama" 
    value="<?php echo $d['nama']; ?>"><br><br>

    <input type="text" name="prodi" 
    value="<?php echo $d['prodi']; ?>"><br><br>

    <input type="email" name="email"
    value="<?php echo $d['email']; ?>"><br><br>

    <input type="text" name="no_hp"
    value="<?php echo $d['no_hp']; ?>"><br><br>

    <button type="submit" name="update">Update</button></form>
</body>
</html>
