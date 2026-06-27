<?php
include 'koneksi.php';

// Memastikan mengecek tombol 'simpan' (sesuai perubahan tombol sebelumnya)
if (isset($_POST['simpan'])) {
    
    // Ambil data dari form HTML
    $nama    = $_POST['nama'];
    $nim     = $_POST['nim'];
    $email   = $_POST['email'];
    $no_hp   = $_POST['no_hp'];
    $jurusan = $_POST['jurusan'];
    $alamat  = ""; // Kita buat kosong dulu karena di form HTML tidak ada input alamat

    // JALANKAN QUERY DENGAN URUTAN YANG BENAR DAN PAS SESUAI PHPMYADMIN
    $query = "INSERT INTO mahasiswa (nim, email, no_hp, nama, jurusan, alamat) 
              VALUES ('$nim', '$email', '$no_hp', '$nama', '$jurusan', '$alamat')";
              
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        // Jika sukses, langsung lempar ke halaman utama
        header("location:index.php");
        exit;
    } else {
        // Jika gagal, bagian ini akan memunculkan teks error yang jelas di browser
        echo "<h3>Gagal menyimpan data!</h3>";
        echo "Pesan Error MySQL: " . mysqli_error($koneksi);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2 class="text-center mb-4">
            Tambah Data Mahasiswa
        </h2>

        <form method="POST" action="">

            <label>Nama</label>
            <input
            type="text"
            name="nama"
            class="form-control mb-3"
            required>

            <label>NIM</label>
            <input
            type="text"
            name="nim"
            class="form-control mb-3"
            required>

            <label>Email</label>
            <input
            type="email"
            name="email"
            class="form-control mb-3"
            required>

            <label>Nomor HP</label>
            <input
            type="text"
            name="no_hp"
            class="form-control mb-3"
            required>

            <label>Jurusan</label>
            <input
            type="text"
            name="jurusan"
            class="form-control mb-3"
            required>

           <button
            type="submit"
            name="simpan"
            class="btn btn-success">
             Simpan
             </button>


            <a href="index.php"
            class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>

