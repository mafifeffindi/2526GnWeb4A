<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        header('Location: index.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container { max-width: 350px; margin: 80px auto; padding: 32px 28px 24px 28px; background: #fff; border-radius: 12px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .form-container h2 { margin-bottom: 24px; color: #2c3e50; text-align: center; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #34495e; font-weight: 500; }
        .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #bdc3c7; border-radius: 6px; font-size: 15px; transition: border-color 0.2s; }
        .form-group input:focus { border-color: #3498db; outline: none; }
        .form-btn { width: 100%; padding: 12px; background: #3498db; color: #fff; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        .form-btn:hover { background: #217dbb; }
        .error { color: red; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body style="background:#f4f6f8;">
<div class="form-container">
    <h2>Login</h2>
    <?php if (!empty($error)) echo '<div class="error">'.$error.'</div>'; ?>
    <form method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button class="form-btn" type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>