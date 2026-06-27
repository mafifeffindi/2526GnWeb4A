<?php
// functions.php - Kumpulan fungsi helper

/**
 * Fungsi 1: Membersihkan dan mengamankan input dari user
 */
function bersihkan_input($data, $koneksi) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($koneksi, $data);
    return $data;
}

/**
 * Fungsi 2: Menampilkan pesan notifikasi (alert)
 */
function tampilkan_notif($pesan, $tipe = 'success') {
    $icon = ($tipe === 'success') ? '✅' : '❌';
    $class = ($tipe === 'success') ? 'notif-success' : 'notif-error';
    echo "<div class='notif {$class}'>{$icon} {$pesan}</div>";
}

/**
 * Fungsi 3: Memformat tampilan stok buku dengan badge warna
 */
function format_stok($stok) {
    if ($stok <= 0) {
        return "<span class='badge badge-habis'>Habis</span>";
    } elseif ($stok <= 5) {
        return "<span class='badge badge-sedikit'>{$stok} buku</span>";
    } else {
        return "<span class='badge badge-tersedia'>{$stok} buku</span>";
    }
}

/**
 * Fungsi 4: Mendapatkan semua data buku dari database
 */
function get_semua_buku($koneksi, $keyword = '') {
    if (!empty($keyword)) {
        $keyword = mysqli_real_escape_string($koneksi, $keyword);
        $sql = "SELECT * FROM buku WHERE judul LIKE '%{$keyword}%' OR pengarang LIKE '%{$keyword}%' OR genre LIKE '%{$keyword}%' ORDER BY id DESC";
    } else {
        $sql = "SELECT * FROM buku ORDER BY id DESC";
    }
    return mysqli_query($koneksi, $sql);
}

/**
 * Fungsi 5: Mendapatkan satu data buku berdasarkan ID
 */
function get_buku_by_id($koneksi, $id) {
    $id = (int)$id;
    $sql = "SELECT * FROM buku WHERE id = {$id}";
    $result = mysqli_query($koneksi, $sql);
    return mysqli_fetch_assoc($result);
}

/**
 * Fungsi 6: Menghitung total buku
 */
function hitung_total_buku($koneksi) {
    $sql = "SELECT COUNT(*) as total FROM buku";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

/**
 * Fungsi 7: Menghitung total stok semua buku
 */
function hitung_total_stok($koneksi) {
    $sql = "SELECT SUM(stok) as total_stok FROM buku";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_stok'] ?? 0;
}
?>
