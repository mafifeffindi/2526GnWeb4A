<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    
    mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi', email='$email', no_hp='$no_hp' WHERE id='$id'");
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4>Edit Data Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label>NIM</label>
                                <input type="text" name="nim" class="form-control" value="<?php echo $d['nim']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $d['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Prodi</label>
                                <input type="text" name="prodi" class="form-control" value="<?php echo $d['prodi']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $d['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Nomor HP</label>
                                <input type="text" name="no_hp" class="form-control" value="<?php echo $d['no_hp']; ?>" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>