<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    mysqli_query($conn,"
        UPDATE mahasiswa SET
        nama='$_POST[nama]',
        nim='$_POST[nim]',
        jurusan='$_POST[jurusan]',
        email='$_POST[email]',
        no_hp='$_POST[no_hp]'
        WHERE id='$id'
    ");

    header("Location: index.php");
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

<h2>Edit Data Mahasiswa</h2>

<form method="POST">

    <input type="text" name="nama"
    value="<?= $row['nama']; ?>" required>

    <input type="text" name="nim"
    value="<?= $row['nim']; ?>" required>

    <input type="text" name="jurusan"
    value="<?= $row['jurusan']; ?>" required>

    <input type="email" name="email"
    value="<?= $row['email']; ?>" required>

    <input type="text" name="no_hp"
    value="<?= $row['no_hp']; ?>" required>

    <button type="submit" name="update">
        Update
    </button>

</form>

</div>

</body>
</html>