<?php
session_start();
// Increase the maximum file size and maximum post size
ini_set('upload_max_filesize', '100M');
ini_set('post_max_size', '100M');

// Increase the maximum execution time
ini_set('max_execution_time', 300);

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

// Define the success and error messages variables
$success_msg = "";
$upload_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["notes_file"])) {
    $notes_file = $_FILES["notes_file"];

    // Check if the file is uploaded without any errors
    if ($notes_file["error"] === 0) {
        $tmp_name = $notes_file["tmp_name"];

        // Store the file in the "uploads" directory with a unique name
        $filename = uniqid() . "_" . $notes_file["name"];
        $destination = "uploads/" . $filename;
        
        if (move_uploaded_file($tmp_name, $destination)) {
            // Get the username from the database
            $user_id = $_SESSION['id'];
            $sql = "SELECT username FROM database1 WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $username);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // Insert the note details into the database
            $sql = "INSERT INTO notes (note_name, note_path, uploaded_by) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $notes_file["name"], $destination, $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            // Set the success message
            $success_msg = "File uploaded successfully.";
        } else {
            // If the file upload failed, set an error message
            $upload_err = "Error uploading the file.";
        }
    } else {
        // If there was an error during file upload, set an error message
        $upload_err = "File upload error: " . $notes_file["error"];
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>College Notes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/semister.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        a {
            color: white;
        }

        .success-message {
            color: green;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5">
                <h1><a href="index.html" class="logo">Notes</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a href="youracc.php"><i class="fa fa-user"></i> Your account</a>
                    </li>
                    <li>
                        <a href="vc.php"><i class="fa fa-video-camera"></i> Video call</a>
                    </li>
                    <li>
                        <a href="yourownnotws.php"><i class="fa fa-book"></i> Upload your notes</a>
                    </li>
                    <li>
                        <a href="shownotes.php"><i class="fa fa-book"></i> Show notes</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                    </li>
                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <!-- ©<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> -->
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </nav>

        <div id="content" class="p-4 p-md-5 pt-5">
            <h1>Upload Your Notes</h1>

            <?php
            // Display success message if it is set
            if (!empty($success_msg)) {
                echo '<div class="success-message">' . $success_msg . '</div>';
            }

            // Check if upload error message is present
            if (!empty($upload_err)) {
                echo '<div class="error-message">' . $upload_err . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="notes_file" required>
                <button type="submit">Upload</button>
            </form>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>