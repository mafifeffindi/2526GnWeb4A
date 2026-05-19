<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // contoh login sederhana
    if($username == "admin" && $password == "123"){
        $_SESSION['login'] = true;
        header("location:index.php");
    } else {
        echo "Username / Password salah";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    Username:<br>
    <input type="text" name="username"><br><br>

    Password:<br>
    <input type="password" name="password"><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>