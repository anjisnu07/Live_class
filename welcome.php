<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';

?>

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

        <div class="container mt-4">
          <h3>Welcome topper! You can now use this website</h3>
          <hr>
        </div>
		
		<!-- Available semester -->
											
			<div class="container d-flex justify-content-center">
			  <ul class="list-group mt-5 text-white">
			    <li class="list-group-item d-flex justify-content-between align-content-center">
			      <div class="d-flex flex-row">
			        <img src="https://img.icons8.com/color/100/000000/folder-invoices.png" width="40" />
			        <div class="ml-2">
			          <h6 class="mb-0"><a href="sem3.php">Sem 3</a></h6>
			        </div>
			      </div>
			      <div class="check">
			        <input type="checkbox" name="a">
			      </div>
			    </li>
			    <li class="list-group-item d-flex justify-content-between align-content-center">
			      <div class="d-flex flex-row">
			        <img src="https://img.icons8.com/color/100/000000/folder-invoices.png" width="40" />
			        <div class="ml-2">
			          <h6 class="mb-0"><a href="sem4.php">Sem-4</a></h6>
			        </div>
			      </div>
			      <div class="check">
			        <input type="checkbox" name="a">
			      </div>
			    </li>
			  </ul>
			</div>
			<!-- Semester ends here  -->

      </div>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
    </body>
</html>