<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

if (isset($_GET['note'])) {
    $noteName = $_GET['note'];

    // Retrieve the note details from the database
    $sql = "SELECT note_name, note_path, uploaded_by FROM notes WHERE note_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $noteName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $noteName, $notePath, $uploadedBy);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Increment the download count
    $sql = "UPDATE notes SET download_count = download_count + 1 WHERE note_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $noteName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to the note file
    header("location: $notePath");
    exit;
} else {
    // If note parameter is not provided, redirect to shownotes.php
    header("location: shownotes.php");
    exit;
}
?>