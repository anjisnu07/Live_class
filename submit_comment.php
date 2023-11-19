<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentText = $_POST['comment_text'];
    $userId = $_SESSION['user_id'];

    $insertCommentQuery = "INSERT INTO comments (user_id, comment_text, created_at) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $insertCommentQuery);
    mysqli_stmt_bind_param($stmt, "is", $userId, $commentText);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: youracc.php");
exit();
?>