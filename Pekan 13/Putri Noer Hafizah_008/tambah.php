<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $prodi = $_POST['prodi'];

    mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama, prodi) 
    VALUES ('$nim', '$nama', '$prodi')");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>

<h2>Tambah Data Mahasiswa</h2>

<form method="post">
    NIM <br>
    <input type="text" name="nim"><br>

    Nama <br>
    <input type="text" name="nama"><br>

    Prodi <br>
    <input type="text" name="prodi"><br><br>

    <input type="submit" name="simpan" value="Simpan">
</form>

</body>
</html>
