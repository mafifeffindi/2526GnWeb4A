<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, 
"select * from mahasiswa where id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $prodi=$_POST['prodi'];

    mysqli_query($koneksi, 
    "update mahasiswa set
    nim='$nim';
    nama='$nama';
    prodi='$prodi';
    where id='$id'");

    header("location:index.php");
}
?>

<! DOCTYPE html>
<html>
<head>
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

<button type "submit" name="update">Update</button>
</form>

</body>
</html>