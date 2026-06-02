<?php
include 'koneksi.php';

// PERBAIKAN 1: Proteksi awal session login agar dinamis
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if ($_SESSION['username'] === 'admin') {
        header("Location: index.php");
    } else {
        header("Location: dashboard_mahasiswa.php");
    }
    exit;
}

$error = false;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Menggunakan perbandingan string biasa (===) sesuai request Anda
        if ($password === $row['password']) { 
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            
            // PERBAIKAN 2: Percabangan halaman berdasarkan Username yang login
            if ($row['username'] === 'admin') {
                header("Location: index.php"); // Jika admin, ke halaman CRUD
            } else {
                header("Location: dashboard_mahasiswa.php"); // Jika mahasiswa/lainnya, ke Portal SIAKAD
            }
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Aplikasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin-top: 10%; }
    </style>
</head>
<body>
<div class="container login-container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4>Aplikasi Mahasiswa</h4>
        </div>
        <div class="card-body p-4">
            <?php if ($error) : ?>
                <div class="alert alert-danger text-center">Username atau Password salah!</div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 mt-2">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
