<?php
include 'db.php';

// Restrict access if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Get student ID
$id = intval($_GET['id']);


$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: dashboard.php");
    exit;
}
$data = mysqli_fetch_assoc($result);

$success = $error = '';

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);

    if (empty($name) || empty($email) || empty($course) || empty($age)) {
        $error = "All fields are required.";
    } else {
        $update = "UPDATE students SET
                   name='$name', email='$email',
                   course='$course', age='$age'
                   WHERE id=$id";
        if (mysqli_query($conn, $update)) {
            $success = "Student updated successfully!";
            // Refresh data
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id=$id"));
        } else {
            $error = "Failed to update student: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student | Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f2f2f2;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-success, .btn-secondary {
            border-radius: 10px;
        }
        .container {
            max-width: 600px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h3 class="text-center text-primary mb-4">Edit Student</h3>

        <?php if ($success) { ?>
            <div class="alert alert-success text-center"><?= $success ?></div>
        <?php } ?>

        <?php if ($error) { ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="course" class="form-control" value="<?= htmlspecialchars($data['course']) ?>" placeholder="Course" required>
            </div>
            <div class="mb-3">
                <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($data['age']) ?>" placeholder="Age" required>
            </div>

            <button type="submit" name="save" class="btn btn-success w-100">Update</button>
        </form>

        <div class="text-center mt-3">
            <a href="dashboard.php" class="btn btn-secondary w-100">Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>