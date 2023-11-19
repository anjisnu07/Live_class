<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $profile_pic = $_FILES["profile_pic"];

    // Check if the file is uploaded without any errors
    if ($profile_pic["error"] === 0) {
        $tmp_name = $profile_pic["tmp_name"];

        // Read the contents of the uploaded file
        $imageData = file_get_contents($tmp_name);

        // Update the profile_pic column in the database
        $sql = "UPDATE database1 SET profile_pic = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $imageData, $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        // Store the file in the "profile_pics" directory with a unique name
        $filename = uniqid() . ".jpg";
        move_uploaded_file($tmp_name, "profile_pics/" . $filename);

        // Update the session variable with the new profile picture filename
        $_SESSION['profile_pic'] = $filename;

        // Redirect back to the account page
        header("location: youracc.php");
        exit;
    }
}

// If the file upload failed, set an error message
$upload_err = "Error uploading the file.";

// Redirect back to the account page with the error message
header("location: youracc.php?upload_err=" . urlencode($upload_err));
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="images\Upload error_page-0001.jpg" alt="Choose a image first to upload" height="1400px" width="1200px">
</body>
</html>