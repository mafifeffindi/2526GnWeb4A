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

$error = "Username atau Password Salah!";

}
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

background:
linear-gradient(
135deg,
#4cdcec,
#243b55
);

height: 100vh;

display: flex;

justify-content: center;

align-items: center;

font-family: Arial;

overflow: hidden;

}

.login-box{

width: 400px;

background: rgba(255,255,255,0.1);

padding: 40px;

border-radius: 20px;

backdrop-filter: blur(10px);

box-shadow: 0 0 20px rgba(0,0,0,0.3);

color: white;

animation: muncul 1s ease;

}

@keyframes muncul{

from{
opacity: 0;
transform: translateY(-30px);
}

to{
opacity: 1;
transform: translateY(0);
}

}

.login-box h2{

text-align: center;

margin-bottom: 30px;

font-weight: bold;

}

.form-control{

border-radius: 12px;

padding: 12px;

}

.btn-login{

background:
linear-gradient(
45deg,
#00c8ffa3,
#9700f5b3
);

border: none;

padding: 12px;

border-radius: 12px;

font-weight: bold;

color: white;

transition: 0.3s;

}

.btn-login:hover{

transform: scale(1.03);

}

.icon{

font-size: 70px;

text-align: center;

display: block;

margin-bottom: 15px;

color: #00c6ff;

}

.footer{

text-align: center;

margin-top: 20px;

font-size: 14px;

color: #ddd;

}

</style>

</head>

<body>

<div class="login-box">

<i class="bi bi-mortarboard-fill icon"></i>

<h2>Login Admin</h2>

<?php
if(isset($error)){
?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<input type="text"
name="username"
class="form-control"
placeholder="Username"
required>

</div>

<div class="mb-3">

<input type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>

<button type="submit"
name="login"
class="btn btn-login w-100">

<i class="bi bi-box-arrow-in-right"></i>
Login

</button>

</form>

<div class="footer">

Syafii

</div>

</div>

</body>
</html>