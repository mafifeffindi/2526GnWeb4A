<?php
session_start();
include 'koneksi.php';
$error = '';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT * FROM user
         WHERE username='$username'
         AND password='$password'");

    if(mysqli_num_rows($query) > 0){
        $_SESSION['login'] = true;
        header("Location:index.php");
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div>
                    <p class="brand">DaniCuyyy</p>
                    <h1 class="page-title">Selamat datang kembali</h1>
                    <p class="subtitle">Masuk untuk mengelola data mahasiswa dengan cepat dan aman.</p>
                </div>
            </div>

            <?php if($error): ?>
                <div class="alert"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" name="login" class="button">Masuk</button>
            </form>

            <div class="form-footer">
                <p>Belum memiliki akun? Hubungi administrator untuk pendaftaran.</p>
            </div>
        </div>
    </div>
</body>
</html>