<?php

include 'koneksi.php';

if(isset($_POST['simpan'])){

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    // PERBAIKAN: Menyebutkan nama kolom secara spesifik sebelum VALUES
    $query = "INSERT INTO mahasiswa (nim, nama, prodi, email, no_hp, jenis_kelamin, alamat) 
              VALUES ('$nim', '$nama', '$prodi', '$email', '$no_hp', '$jenis_kelamin', '$alamat')";
              
    $simpan = mysqli_query($koneksi, $query);

    // Fitur Tambahan: Jika gagal, aplikasi akan memunculkan pesan error agar mudah dilacak
    if($simpan){
        header("location:index.php");
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="form-container">
    <h2>Tambah Data Mahasiswa</h2>
    <form method="POST">
        <label>NIM</label>
        <input type="text" name="nim" placeholder="Masukkan NIM" required>

        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama" required>

        <label>Prodi</label>
        <input type="text" name="prodi" placeholder="Masukkan Prodi" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" required>

        <label>Nomor HP</label>
        <input type="text" name="no_hp" placeholder="Masukkan Nomor HP" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" placeholder="Masukkan Alamat" required></textarea>

        <div class="button-group">
            <button type="submit" name="simpan">Simpan</button>
            <a href="index.php" class="kembali">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
