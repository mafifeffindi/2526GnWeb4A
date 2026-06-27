<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,
        "INSERT INTO mahasiswa VALUES('','$nama','$nim','$jurusan','$email','$no_hp')");

    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card" style="max-width: 600px; margin: 48px auto;">
            <h1 class="page-title">Tambah Mahasiswa</h1>
            <p class="subtitle">Isi data mahasiswa baru dengan lengkap untuk menyimpan ke dalam daftar.</p>

            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input id="nim" type="text" name="nim" required>
                </div>

                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input id="jurusan" type="text" name="jurusan" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input id="no_hp" type="text" name="no_hp" required>
                </div>

                <div class="actions">
                    <button type="submit" name="simpan" class="button">Simpan</button>
                    <a href="index.php" class="button secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>