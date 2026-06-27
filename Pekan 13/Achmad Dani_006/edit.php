<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,
    "UPDATE mahasiswa SET

    nama='$nama',
    nim='$nim',
    jurusan='$jurusan',
    email='$email',
    no_hp='$no_hp'

    WHERE id='$id'
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>

<h2>EDIT DATA</h2>

<form method="POST">

Nama <br>
<input type="text"
name="nama"
value="<?php echo $d['nama']; ?>">
<br><br>

NIM <br>
<input type="text"
name="nim"
value="<?php echo $d['nim']; ?>">
<br><br>

Jurusan <br>
<input type="text"
name="jurusan"
value="<?php echo $d['jurusan']; ?>">
<br><br>

Email <br>
<input type="email"
name="email"
value="<?php echo $d['email']; ?>">
<br><br>

No HP <br>
<input type="text"
name="no_hp"
value="<?php echo $d['no_hp']; ?>">
<br><br>

<button type="submit" name="submit">
    Update
</button>

</form>

</body>
</html>