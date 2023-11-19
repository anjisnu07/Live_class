<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

// Retrieve the notes from the database
$sql = "SELECT note_name, uploaded_by FROM notes";
$result = mysqli_query($conn, $sql);
$notes = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
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
</head>

<body>
    <!-- Main page it its -->
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
                    <p></p>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h1>Notes</h1>

            <?php
            foreach ($notes as $note) {
                $noteName = $note['note_name'];
                $uploadedBy = $note['uploaded_by'];
                echo "<p><a href='viewnote.php?note=" . urlencode($noteName) . "'>$noteName</a> - Uploaded by: <a href='userdetails.php?username=$uploadedBy'>$uploadedBy</a></p>";
            }
            ?>

        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>