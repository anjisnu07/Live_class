<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

// Fetch user information from the database
$sql = "SELECT username, number, gmail, sem, collegeid, profile_pic FROM database1 WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $number, $gmail, $sem, $collegeid, $profilePic);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>



<!doctype html>
<html lang="en">
<head>
    <title>Your Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>

  <style>
    a{
        color: white;
    }
    .circle {
            width: 150px;
            height: 150px;
            background-color: #ccc;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .camera-icon i {
            color: #333;
            font-size: 20px;
        }

        .hidden-input {
            display: none;
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
              <a href="index.php">Home</a>
	          </li> 

			  <li>
              <a href="logout.php">Log out</a>
	          </li>
	        </ul>

	       

	  

	      </div>
    	</nav>

<div id="content" class="p-4 p-md-5 pt-5">


<div class="container mt-4">
        <h3>Your Account Information</h3>
        <hr>
        
        <div class="circle">
            <?php if ($profilePic): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($profilePic); ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="default_profile_pic.png" alt="Default Profile Picture">
            <?php endif; ?>
        </div>

        <h5>Change Profile Picture</h5>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="profile_pic">
            <input type="submit" value="Upload">
            <?php if (!empty($upload_err)): ?>
                <p><?php echo $upload_err; ?></p>
            <?php endif; ?>
        </form>

        <!-- Display current profile picture if available -->
        <br>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Number:</strong> <?php echo $number; ?></p>
        <p><strong>Gmail:</strong> <?php echo $gmail; ?></p>
        <p><strong>Semester:</strong> <?php echo $sem; ?></p>
        <p><strong>College ID:</strong> <?php echo $collegeid; ?></p>
    </div>
</div>
</body>

    <script>
        document.getElementById('file-input').addEventListener('change', function(event) {
    var input = event.target;
    var reader = new FileReader();
     reader.onload = function() {
     var image = document.getElementById('profile-image');
    image.src = reader.result;
     };
     reader.readAsDataURL(input.files[0]);
    });
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>  