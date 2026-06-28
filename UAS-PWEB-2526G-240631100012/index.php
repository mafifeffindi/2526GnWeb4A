<?php 
require 'fungsi.php'; 
include 'header.php'; 

// Menggunakan Perulangan/Fungsi untuk menghitung total mahasiswa (Variabel & Percabangan)
$data_mhs = ambilSemuaMahasiswa($koneksi);
$total_mhs = count($data_mhs);
?>

<div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang di SI Mahasiswa</h1>
        <p class="col-md-8 fs-4 text-secondary">Aplikasi pendataan mahasiswa sederhana untuk memenuhi spesifikasi tugas UAS pemrograman web.</p>
        <hr class="my-4">
        
        <?php if ($total_mhs > 0): ?>
            <div class="alert alert-info d-inline-block">
                Saat ini terdapat <strong><?= $total_mhs; ?></strong> mahasiswa terdaftar dalam sistem.
            </div>
        <?php else: ?>
            <div class="alert alert-warning d-inline-block">
                Belum ada data mahasiswa yang tersimpan.
            </div>
        <?php endif; ?>
        
        <div class="mt-3">
            <a href="tampil.php" class="btn btn-primary btn-lg">Lihat Daftar Data</a>
            <a href="tambah.php" class="btn btn-outline-secondary btn-lg">Tambah Data Baru</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>