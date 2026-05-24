<?php
include 'koneksi.php';
if(isset($_POST['simpan'])){

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    
    mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, prodi) VALUES('$nim', '$nama', '$prodi')");
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
        <input type="text" name="nim" placeholder="NIM"><br><br>
        <input type="text" name="nama" placeholder="Nama"><br><br>
        <input type="text" name="prodi" placeholder="Prodi"><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>
