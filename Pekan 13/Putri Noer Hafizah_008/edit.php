<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nim  = $_POST['nim'];
    $nama = $_POST['nama'];

    mysqli_query($conn, "UPDATE mahasiswa 
        SET nim='$nim', nama='$nama' 
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

<h2>Edit Data</h2>

<form method="post">
    NIM <br>
    <input type="text" name="nim" value="<?php echo $d['nim']; ?>"><br>

    Nama <br>
    <input type="text" name="nama" value="<?php echo $d['nama']; ?>"><br><br>

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
