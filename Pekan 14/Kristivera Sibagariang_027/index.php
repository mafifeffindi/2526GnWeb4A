<?php

session_start();

if($_SESSION['status'] != "login") {
    header("location:login.php");
}

include 'koneksi.php';

$cari = "";

if(isset($_GET['cari'])) {

    $cari = $_GET['cari'];

    $data = mysqli_query($koneksi,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'
    OR nim LIKE '%$cari%'");

} else {

    $data = mysqli_query($koneksi,
    "SELECT * FROM mahasiswa");

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Data Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="text-center mb-4">
            Data Mahasiswa
        </h2>

        <div class="mb-3">

            <a href="tambah.php" class="btn btn-primary">
                + Tambah Data
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

        <form method="GET" class="mb-3">

            <input
            type="text"
            name="cari"
            class="form-control"
            placeholder="Cari nama atau NIM">

        </form>

        <table class="table table-bordered table-striped">

            <tr>

                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Jurusan</th>
                <th>Aksi</th>

            </tr>

            <?php

            $no = 1;

            while($d = mysqli_fetch_array($data)) {

            ?>

            <tr>

                <td><?php echo $no++; ?></td>

                <td><?php echo $d['nama']; ?></td>

                <td><?php echo $d['nim']; ?></td>

                <td><?php echo $d['email']; ?></td>

                <td><?php echo $d['no_hp']; ?></td>

                <td><?php echo $d['jurusan']; ?></td>

                <td>

                    <a href="edit.php?id=<?php echo $d['id']; ?>"
                    class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="hapus.php?id=<?php echo $d['id']; ?>"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus data?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
