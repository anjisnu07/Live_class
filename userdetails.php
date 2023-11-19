



<!doctype html>
<html lang="en">
  <head>
  	<title>College Notes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css\semister.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
  </head>

  <style>
    a{
        color: white;
    }
  </style>

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
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  <!-- ©<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> -->
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div> 

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
      <?php
session_start();

require_once "config.php";

if (isset($_GET["username"])) {
    $username = $_GET["username"];

    // Retrieve user details from the database
    $sql = "SELECT * FROM database1 WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($user) {
        $username = $user['username'];
        $profilePicture = $user['profile_pic'];
        $sem = $user['sem'];
        $collegeID = $user['collegeid'];
        $email = $user['gmail'];

        // Output the user details
         // Display the profile picture
         echo "<h1>User Details</h1>";
         if ($profilePicture) {
            echo "<div style='width: 100px; height: 100px; border-radius: 50%; overflow: hidden;'>
                    <img src='data:image/jpeg;base64," . base64_encode($profilePicture) . "' alt='Profile Picture' style='width: 100%; height: 100%; object-fit: cover; object-position: 50% 50%;'>
                  </div>";
        } else {
            echo "No profile picture available.";
        }
        
        echo "<p>Username: $username</p>";
        echo "<p>Sem: $sem</p>";
        echo "<p>College ID: $collegeID</p>";
        echo "<p>Email: $email</p>";
        
       
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}
?>
			<!-- Semester ends here  -->

      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
    </body>
</html>