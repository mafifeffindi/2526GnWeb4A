<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
    $d = mysqli_fetch_array($data);
}

if (isset($_POST['update'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    

    $query = mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi' WHERE id='$id'");
    
    if ($query) {
        header("location:index.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Mahasiswa</title>
</head>
<body>
    <h2>Edit Data Mahasiswa</h2>
    <form method="post">
        <label>NIM:</label><br>
        <input type="text" name="nim" value="<?php echo $d['nim']; ?>" required><br><br>
        
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $d['nama']; ?>" required><br><br>
        
        <label>Prodi:</label><br>
        <input type="text" name="prodi" value="<?php echo $d['prodi']; ?>" required><br><br>
        
        <button type="submit" name="update">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
