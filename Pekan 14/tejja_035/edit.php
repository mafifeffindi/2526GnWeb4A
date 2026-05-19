php
<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn, "UPDATE mahasiswa SET
        nama='$nama',
        nim='$nim',
        prodi='$prodi',
        email='$email',
        no_hp='$no_hp'
        WHERE id='$id'");

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
        <input type="text" name="nama" value="<?= $d['nama']; ?>" required>
        <input type="text" name="nim" value="<?= $d['nim']; ?>" required>
        <input type="text" name="prodi" value="<?= $d['prodi']; ?>" required>
        <input type="email" name="email" value="<?= $d['email']; ?>" required>
        <input type="text" name="no_hp" value="<?= $d['no_hp']; ?>" required>

        <button type="submit" name="update">Update</button>
    </form>
</div>

</body>
</html>