<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $prodi = $_POST['prodi'];
    
    // Nilai pertama dikosongkan karena 'id' adalah AUTO_INCREMENT
    mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES('', '$nim', '$nama', '$prodi')");
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
        <input type="text" name="nim" placeholder="NIM" required><br><br>
        <input type="text" name="nama" placeholder="Nama" required><br><br>
        <input type="text" name="prodi" placeholder="Prodi" required><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>
</html>