<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Universitas Trunojoyo Madura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center text-center">

    <div class="container">
        <div class="p-5 bg-white rounded shadow-sm mx-auto" style="max-width: 600px;">
            <h3 class="fw-bold text-primary mb-2">Universitas Trunojoyo Madura</h3>
            <p class="lead text-muted font-italic mb-0">Unggul Tangguh Mandiri</p>
        </div>
    </div>

</body>
</html>
