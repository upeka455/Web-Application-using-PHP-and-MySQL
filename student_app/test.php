<?php
$conn = mysqli_connect("localhost:4306", "root", "", "student_app");

if ($conn) {
    echo " DATABASE CONNECTED SUCCESSFULLY";
} else {
    echo " ERROR: " . mysqli_connect_error();
}
?>