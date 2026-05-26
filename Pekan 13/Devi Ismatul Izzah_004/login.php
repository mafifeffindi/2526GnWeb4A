<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi,
        "SELECT * FROM users
        WHERE username='$username'
        AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['login'] = true;
        header("Location: index.php");
    } else {
        echo "<script>alert('Login gagal!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container mt-5">

<div class="card col-md-4 mx-auto shadow">

<div class="card-header text-center">
<h3>Login CRUD</h3>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text"
name="username"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password"
name="password"
class="form-control"
required>
</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">
Login
</button>

</form>

</div>
</div>
</div>

</body>
</html>