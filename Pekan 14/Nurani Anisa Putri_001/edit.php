<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");


if (mysqli_num_rows($data) == 0) {
    header("Location: index.php");
    exit;
}

$d = mysqli_fetch_array($data);

if (isset($_POST['update'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];

    $query = mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi', email='$email', nohp='$nohp' WHERE id='$id'");
    
    if ($query) {
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui data: " . mysqli_error($koneksi) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark p-3">
                    <h5 class="mb-0"><strong>Form Edit Data Mahasiswa</strong></h5>
                </div>
                <div class="card-body p-4">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?php echo $d['nim']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $d['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="<?php echo $d['prodi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $d['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <input type="text" name="nohp" class="form-control" value="<?php echo $d['nohp']; ?>" required>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="update" class="btn btn-warning text-dark"><strong>Update Data</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
