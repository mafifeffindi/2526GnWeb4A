<?php
session_start();

include 'koneksi.php';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi,
    "SELECT * FROM users
    WHERE username='$username'
    AND password='$password'");

    $cek = mysqli_num_rows($data);

    if($cek > 0) {

        $_SESSION['status'] = "login";

        header("location:index.php");

    } else {

        echo "Username atau password salah";

    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="card p-4">

<h3>Login</h3>

<form method="POST">

<input type="text"
name="username"
class="form-control mb-3"
placeholder="Username">

<input type="password"
name="password"
class="form-control mb-3"
placeholder="Password">

<button type="submit"
name="login"
class="btn btn-primary">
Login
</button>

</form>

<br>

<a href="register.php">
Belum punya akun? Register
</a>

</div>
</div>

</body>
</html>
