<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Menggunakan validasi sederhana (Bisa disesuaikan dengan tabel user di DB jika ada)
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['status_login'] = true;
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Aplikasi CRUD</h3>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger p-2 small"><?= $error; ?></div>
                        <?php endif; ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required placeholder="admin">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="admin123">
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>