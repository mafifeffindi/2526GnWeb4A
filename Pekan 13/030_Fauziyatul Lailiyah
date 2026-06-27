<?php

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    mysqli_query($koneksi,

    "UPDATE mahasiswa SET

    nim='$nim',
    nama='$nama',
    prodi='$prodi',
    email='$email',
    no_hp='$no_hp',
    jenis_kelamin='$jenis_kelamin',
    alamat='$alamat'

    WHERE id='$id'
    ");

    header("location:index.php");

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Data</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>

<div class="form-container">

<h2>Edit Data Mahasiswa</h2>

<form method="POST">

<label>NIM</label>

<input
type="text"
name="nim"
value="<?php echo $d['nim']; ?>"
required>

<label>Nama</label>

<input
type="text"
name="nama"
value="<?php echo $d['nama']; ?>"
required>

<label>Prodi</label>

<input
type="text"
name="prodi"
value="<?php echo $d['prodi']; ?>"
required>

<label>Email</label>

<input
type="email"
name="email"
value="<?php echo $d['email']; ?>"
required>

<label>Nomor HP</label>

<input
type="text"
name="no_hp"
value="<?php echo $d['no_hp']; ?>"
required>

<label>Jenis Kelamin</label>

<select name="jenis_kelamin">

<option
<?php
if($d['jenis_kelamin']=="Laki-laki"){
    echo "selected";
}
?>>

Laki-laki

</option>

<option
<?php
if($d['jenis_kelamin']=="Perempuan"){
    echo "selected";
}
?>>

Perempuan

</option>

</select>

<label>Alamat</label>

<textarea
name="alamat"><?php echo $d['alamat']; ?></textarea>

<div class="button-group">

<button
type="submit"
name="update">

Update

</button>

<a href="index.php" class="kembali">
Kembali
</a>

</div>
</form>
</div>
</body>
</html>
