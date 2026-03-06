<?php
session_start();


if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card shadow p-4 text-center" style="max-width: 450px; width:100%;">
        
        <h2 class="mb-3 text-primary">Student Management System</h2>
        <p class="text-muted">
            PHP & MySQL based CRUD Application
            
        </p>

        <hr>

        <a href="login.php" class="btn btn-primary w-100 mb-2">
            Login to System
        </a>

        <small class="text-muted">
            Individual Web Application Assignment
        </small>

    </div>
</div>

</body>
</html>