<?php
include 'db.php';

$success = $error = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Both fields are required";
    } else {
        $hash = md5($password); 
        mysqli_query($conn, "INSERT INTO users (username,password) VALUES ('$username','$hash')");
        $success = "Registration successful! <a href='login.php'>Login here</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 shadow">
        <h3 class="text-center text-success mb-3">Register</h3>

        <?php if ($success) echo '<div class="alert alert-success">'.$success.'</div>'; ?>
        <?php if ($error) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>

        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button type="submit" name="register" class="btn btn-success w-100">Register</button>
        </form>

        <p class="text-center mt-3">
            <a href="login.php">Already have an account? Login</a>
        </p>
    </div>
</div>

</body>
</html>