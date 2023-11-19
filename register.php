<?php
require_once "config.php";

$username = $password = $confirm_password = $number = $gmail = $sem = $collegeid = "";
$username_err = $password_err = $confirm_password_err = $number_err = $gmail_err = $sem_err = $collegeid_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match";
    }

    if (empty(trim($_POST['number']))) {
        $number_err = "Mobile number cannot be blank";
    } else {
        $number = trim($_POST['number']);
    }

    if (empty(trim($_POST['gmail']))) {
        $gmail_err = "Gmail cannot be blank";
    } else {
        $gmail = trim($_POST['gmail']);
    }

    if (empty(trim($_POST['sem']))) {
        $sem_err = "Semester cannot be blank";
    } else {
        $sem = trim($_POST['sem']);
    }

    if (empty(trim($_POST['collegeid']))) {
        $collegeid_err = "College ID cannot be blank";
    } else {
        $collegeid = trim($_POST['collegeid']);
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($number_err) && empty($gmail_err) && empty($sem_err) && empty($collegeid_err)) {
        // Check if the mobile number already exists
        $sql = "SELECT id FROM database1 WHERE number = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_number);
            $param_number = $number;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $number_err = "This mobile number is already registered";
                }
            } else {
                echo "Something went wrong";
            }

            mysqli_stmt_close($stmt);
        }

        if (empty($number_err)) {
            $sql = "INSERT INTO database1 (username, password, number, gmail, sem, collegeid) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssi", $param_username, $param_password, $param_number, $param_gmail, $param_sem, $param_collegeid);
        
                $param_username = $username;
                $param_password = $password;
                $param_number = $number;
                $param_gmail = $gmail;
                $param_sem = $sem;
                $param_collegeid = $collegeid;
        
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    header("location: login.php");
                    exit();
                } else {
                    echo "Something went wrong... cannot redirect!";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>
<div class="error-message">
    <?php echo $username_err; ?>
</div>
<div class="error-message">
    <?php echo $password_err; ?>
</div>
<div class="error-message">
    <?php echo $confirm_password_err; ?>
</div>
<div class="error-message">
    <?php echo $number_err; ?>
</div>
<div class="error-message">
    <?php echo $gmail_err; ?>
</div>
<div class="error-message">
    <?php echo $sem_err; ?>
</div>
<div class="error-message">
    <?php echo $collegeid_err; ?>
</div>
<!doctype html>
<html lang="en">
  <head>
  	<title>College Notes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css\semister.css">
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


		  		<h1><a href="index.php" class="logo">Notes</a></h1>
	        <ul class="list-unstyled components mb-5">
	          
	            
	         
	          <li>
              <a href="login.php">Log in</a>
	          </li>

			  
	        </ul>

	       

	       <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a> -->
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div> 

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">


      <div class="container mt-4">
<h3>Please Register Here:</h3>
<hr>
<form action="" method="post">
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Username</label>
        <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="John Doe" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" required>
    </div>
</div>
<div class="form-group">
    <label for="inputPassword4">Confirm Password</label>
    <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="Confirm Password" required>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputnumber">Mobile no:</label>
        <input type="text" class="form-control" name="number" id="inputnumber" placeholder="9883238921" pattern="[0-9]{10}" required>
    </div>
    <div class="error-message">
</div>
    <div class="form-group col-md-6">
        <label for="inputmail">Gmail:</label>
        <input type="email" class="form-control" name="gmail" id="inputmail" placeholder="air@gmail.com" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputCity">Semester:</label>
        <input type="text" class="form-control" name="sem" id="inputCity" placeholder="4" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inputZip">College ID:</label>
        <input type="text" class="form-control" name="collegeid" id="inputZip" placeholder="211003003101" required>
    </div>
</div>
<button type="submit" class="btn btn-primary">Sign in</button>
</form>

</div>
<div class="btn"><h6>Already have an account? <a href="login.php">Log in</a></h6></div>
</div>




    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>































  
