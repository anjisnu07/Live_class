<?php
require_once "config.php";

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve the profile picture from the database
    $sql = "SELECT profile_pic FROM database1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $profilePicture = $row['profile_pic'];

    // Set the appropriate headers and output the image
    header("Content-type: image/jpeg");
    echo $profilePicture;
} else {
    echo "Invalid request.";
}