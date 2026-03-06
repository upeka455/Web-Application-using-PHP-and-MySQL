<?php
$conn = mysqli_connect("localhost:4306", "root", "", "student_app");

if (!$conn) {
    die("Database Connection Failed");
}
session_start();
?>