<?php
include 'koneksi.php';

$sampleData = [
    ['Alice Hartono', '211020', 'Teknik Informatika', 'alice.hartono@example.com', '081234567890'],
    ['Budi Santoso', '211021', 'Sistem Informasi', 'budi.santoso@example.com', '082345678901'],
    ['Citra Wijaya', '211022', 'Teknik Elektro', 'citra.wijaya@example.com', '083456789012'],
    ['Dina Pratiwi', '211023', 'Manajemen', 'dina.pratiwi@example.com', '084567890123'],
    ['Eka Putra', '211024', 'Akuntansi', 'eka.putra@example.com', '085678901234']
];

foreach ($sampleData as $item) {
    list($nama, $nim, $jurusan, $email, $no_hp) = $item;
    mysqli_query($conn, "INSERT INTO mahasiswa VALUES('', '$nama', '$nim', '$jurusan', '$email', '$no_hp')");
}

header('Location: index.php');
exit;
