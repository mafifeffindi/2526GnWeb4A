<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])){
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', email='$email', no_hp='$no_hp' WHERE id='$id'");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>

<h2>Edit Data Mahasiswa</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama" value="<?php echo $d['nama']; ?>"><br><br>

    Email:<br>
    <input type="email" name="email" value="<?php echo $d['email']; ?>"><br><br>

    No HP:<br>
    <input type="text" name="no_hp" value="<?php echo $d['no_hp']; ?>"><br><br>

    <button type="submit" name="submit">Update</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>