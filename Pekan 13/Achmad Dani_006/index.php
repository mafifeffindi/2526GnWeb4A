<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$cari = "";

if(isset($_GET['cari'])){

    $cari = $_GET['cari'];

    $query = mysqli_query($conn,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'");

} else {

    $query = mysqli_query($conn,
    "SELECT * FROM mahasiswa");

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>

<h2>DATA MAHASISWA</h2>

<a href="tambah.php">Tambah Data</a>
<br><br>

<form method="GET">

    <input type="text"
    name="cari"
    placeholder="Cari nama">

    <button type="submit">
        Cari
    </button>

</form>

<br>

<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIM</th>
    <th>Jurusan</th>
    <th>Email</th>
    <th>No HP</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_array($query)){
?>

<tr>

    <td><?php echo $no++; ?></td>

    <td><?php echo $d['nama']; ?></td>

    <td><?php echo $d['nim']; ?></td>

    <td><?php echo $d['jurusan']; ?></td>

    <td><?php echo $d['email']; ?></td>

    <td><?php echo $d['no_hp']; ?></td>

    <td>

        <a href="edit.php?id=<?php echo $d['id']; ?>">
            Edit
        </a>

        |

        <a href="hapus.php?id=<?php echo $d['id']; ?>"
        onclick="return confirm('Yakin hapus data?')">
            Hapus
        </a>

    </td>

</tr>

<?php } ?>

</table>

<br>

<a href="logout.php">Logout</a>

</body>
</html>