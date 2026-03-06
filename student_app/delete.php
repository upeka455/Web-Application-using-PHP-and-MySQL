<?php
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Get student ID
$id = intval($_GET['id']);

// Delete student
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    if (mysqli_query($conn, "DELETE FROM students WHERE id=$id")) {
        $msg = "Student deleted successfully!";
        header("Location: dashboard.php?msg=" . urlencode($msg));
        exit;
    } else {
        $msg = "Failed to delete student: " . mysqli_error($conn);
        header("Location: dashboard.php?msg=" . urlencode($msg));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student | Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            margin-top: 100px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="card p-4 text-center">
    <h4 class="text-danger mb-3">Are you sure you want to delete this student?</h4>
    

    <a href="delete.php?id=<?= $id ?>&confirm=yes" class="btn btn-danger me-2">Yes, Delete</a><br>
    <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
</div>

</body>
</html>