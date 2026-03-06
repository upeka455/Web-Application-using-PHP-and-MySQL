<?php
include 'db.php';

// Redirect if already logged in
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

// Handle login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // hashed password

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $username;

        // Remember Me functionality
        if (isset($_POST['remember'])) {
            setcookie('user', $username, time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            border-radius: 10px;
        }
        .card-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .text-error {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .links a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="card-header">
        <h3 class="text-primary fw-bold">Student Management System</h3>
        <p class="text-muted"> Login</p>
    </div>

    <?php if ($error) { ?>
        <div class="text-error text-center"><?= $error ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?= isset($_COOKIE['user']) ? $_COOKIE['user'] : '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="remember" id="remember" <?= isset($_COOKIE['user']) ? 'checked' : '' ?>>
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <button type="submit" name="login" class="btn btn-primary w-100 mb-2">Login</button>

        <div class="d-flex justify-content-between links">
            
            <a href="register.php">Do you have an account? Register</a>
        </div>
    </form>

    <hr>
    <p class="text-center text-muted small mb-0">© 2026 Student Management System</p>
</div>

</body>
</html>