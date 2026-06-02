<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi,
    "SELECT * FROM users
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($cek) > 0){

        $_SESSION['login'] = true;

        header("location:index.php");

    }else{

        echo "Login Gagal";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Login</h2>

<form method="post">

<input type="text"
name="username"
placeholder="Username"><br><br>

<input type="password"
name="password"
placeholder="Password"><br><br>

<button type="submit"
name="login">

Login

</button>

</form>

</div>

</body>
</html>