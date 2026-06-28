<?php
// ============================================================
// functions.php — Shared Helper Functions
// ============================================================

/**
 * Format angka menjadi format Rupiah
 * Contoh: 150000 → Rp 150.000
 */
function formatRupiah(float $nominal): string {
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

/**
 * Format tanggal dari Y-m-d ke format Indonesia
 * Contoh: 2025-06-01 → 1 Juni 2025
 */
function formatTanggal(string $tanggal): string {
    $bulan = [
        1  => 'Jan', 2  => 'Feb', 3  => 'Mar', 4  => 'Apr',
        5  => 'Mei', 6  => 'Jun', 7  => 'Jul', 8  => 'Agu',
        9  => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];
    $ts = strtotime($tanggal);
    return date('d', $ts) . ' ' . $bulan[(int)date('m', $ts)] . ' ' . date('Y', $ts);
}

/**
 * Hitung ringkasan keuangan dari result set MySQL
 * Returns: ['masuk' => float, 'keluar' => float, 'saldo' => float]
 */
function hitungRingkasan(mysqli $conn): array {
    $result = ['masuk' => 0, 'keluar' => 0, 'saldo' => 0];

    $q = $conn->query("SELECT tipe, SUM(jumlah) AS total FROM catatan GROUP BY tipe");
    if ($q && $q->num_rows > 0) {
        while ($row = $q->fetch_assoc()) {
            if ($row['tipe'] === 'masuk')  $result['masuk']  = (float)$row['total'];
            if ($row['tipe'] === 'keluar') $result['keluar'] = (float)$row['total'];
        }
    }
    $result['saldo'] = $result['masuk'] - $result['keluar'];
    return $result;
}

/**
 * Sanitize input string
 */
function bersihkan(string $input): string {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Redirect helper
 */
function redirect(string $url): void {
    header("Location: $url");
    exit;
}

/**
 * Set session flash message
 */
function setFlash(string $tipe, string $pesan): void {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

/**
 * Get & clear flash message, returns HTML string or empty string
 */
function getFlash(): string {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['flash'])) return '';
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    $cls = $f['tipe'] === 'sukses' ? 'alert-success' : 'alert-error';
    return '<div class="alert ' . $cls . '">' . bersihkan($f['pesan']) . '</div>';
}
?>
