<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
    "SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,
        "UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan', email='$email', no_hp='$no_hp' WHERE id='$id'");

    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card" style="max-width: 600px; margin: 48px auto;">
            <h1 class="page-title">Edit Mahasiswa</h1>
            <p class="subtitle">Perbarui data mahasiswa sesuai informasi terbaru.</p>

            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" name="nama" value="<?php echo htmlspecialchars($d['nama']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input id="nim" type="text" name="nim" value="<?php echo htmlspecialchars($d['nim']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input id="jurusan" type="text" name="jurusan" value="<?php echo htmlspecialchars($d['jurusan']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="<?php echo htmlspecialchars($d['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input id="no_hp" type="text" name="no_hp" value="<?php echo htmlspecialchars($d['no_hp']); ?>" required>
                </div>

                <div class="actions">
                    <button type="submit" name="update" class="button">Update</button>
                    <a href="index.php" class="button secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>