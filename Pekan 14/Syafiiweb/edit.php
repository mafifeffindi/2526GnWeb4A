<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
}

include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_array(
mysqli_query($conn,
"SELECT * FROM mahasiswa
WHERE id='$id'")
);

if(isset($_POST['update'])){

mysqli_query($conn,

"UPDATE mahasiswa SET

nama='$_POST[nama]',
nim='$_POST[nim]',
jurusan='$_POST[jurusan]',
email='$_POST[email]',
no_hp='$_POST[no_hp]'

WHERE id='$id'"

);

header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Data</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Edit Mahasiswa</h2>

<form method="POST">

<input type="text"
name="nama"
value="<?= $data['nama']; ?>">

<input type="text"
name="nim"
value="<?= $data['nim']; ?>">

<input type="text"
name="jurusan"
value="<?= $data['jurusan']; ?>">

<input type="email"
name="email"
value="<?= $data['email']; ?>">

<input type="text"
name="no_hp"
value="<?= $data['no_hp']; ?>">

<button name="update">
Update
</button>

</form>

</div>

</body>
</html>