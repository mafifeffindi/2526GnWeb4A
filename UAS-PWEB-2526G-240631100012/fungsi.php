<?php
// Koneksi ke Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_mahasiswa";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// FUNGSI 1: Mengambil semua data mahasiswa (Read)
function ambilSemuaMahasiswa($koneksi) {
    $query = "SELECT * FROM mahasiswa ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNGSI 2: Mengambil satu data mahasiswa berdasarkan ID (Untuk Edit)
function ambilMahasiswaPerId($koneksi, $id) {
    $id = mysqli_real_escape_string($koneksi, $id);
    $query = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}
?>