<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi,
    "SELECT * FROM user
    WHERE username='$username'
    AND password='$password'");

    $cek = mysqli_num_rows($data);

    if($cek > 0){

        $_SESSION['status'] = "login";

        header("location:index.php");

    } else {

        echo "Username atau Password salah";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

<body>

<div class="login-container">

    <div class="login-box">

        <h2>Login</h2>

        <form method="post">

            <input type="text"
            name="username"
            placeholder="Username">

            <input type="password"
            name="password"
            placeholder="Password">

            <button type="submit"
            name="login">
            Login
            </button>

        </form>

    </div>

</div>
</body>
</html>
