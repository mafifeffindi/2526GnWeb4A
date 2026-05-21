<?php
session_start();

$username = "admin";
$password = "123";

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == $username && $pass == $password){

        $_SESSION['login'] = true;

        header("location:index.php");

    }else{
        echo "Username atau Password salah!";
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

    <input type="text" name="username" placeholder="Username"><br><br>

    <input type="password" name="password" placeholder="Password"><br><br>

    <button type="submit" name="login">Login</button>

</form>

</div>

</body>
</html>