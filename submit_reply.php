<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $replyText = $_POST['reply_text'];
    $commentId = $_POST['comment_id'];
    $userId = $_SESSION['user_id'];

    $insertReplyQuery = "INSERT INTO replies (user_id, comment_id, reply_text, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $insertReplyQuery);
    mysqli_stmt_bind_param($stmt, "iis", $userId, $commentId, $replyText);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: youracc.php");
exit();
?>