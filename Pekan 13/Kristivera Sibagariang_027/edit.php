<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi, "UPDATE mahasiswa SET
    nama='$nama',
    nim='$nim',
    jurusan='$jurusan'
    WHERE id='$id'");

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

    <label>Nama</label><br>
    <input type="text" name="nama"
    value="<?php echo $d['nama']; ?>"><br><br>

    <label>NIM</label><br>
    <input type="text" name="nim"
    value="<?php echo $d['nim']; ?>"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan"
    value="<?php echo $d['jurusan']; ?>"><br><br>

    <button type="submit" name="submit">Update</button>

</form>

</body>
</html>
