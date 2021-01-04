
<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $company = $_POST["company"];
	$password = $_POST["password"];
	 // Connecting to the Database
	 $servername = "localhost:3308";
	 $username = "root";
	 $password = "";
	 $database = "manufacturers";

	  // Create a connection
	  $conn = mysqli_connect($servername, $username, $password, $database);

	  // Die if connection was not successful
	  if (!$conn){
		  die("Sorry we failed to connect: ". mysqli_connect_error());
	  }
	  else{
		$sql = "SELECT * FROM manufacturer WHERE `name`='$company' AND `password`='$password'";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
	  }


		if ($num == 1){
			$login = true;
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['password'] = $password;
			$_SESSION['company'] = $company;
			header("location: home_manufacturer.php");

		}
    else{
        echo "<script>alert(\"Invalid Credentials...try again\");</script>";
	}
	if($login){
		echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Success!</strong> You are logged in
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
		}
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>signin</title>
		<link rel="stylesheet" href="css/login_style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
	</head>
	<body>

		<!--form area start-->
		<div class="form">
			<!--login form start-->
			<form class="login-form" action="login_manufacturer.php" method="post">
				<i class="fas fa-user-circle"></i>
				<input class="user-input" type="text" name="company" placeholder="Company Name" required>
				<input class="user-input" type="password" name="password" placeholder="Password" required>
				<input class="btn" type="submit" name="login-btn" value="LOGIN">

				<div class="options-02">
					<p>Not Registered? <a href="regis_manufacturer.php">Create an Account</a></p>
				</div>
			</form>
			<!--login form end-->
		</div>
		<!--form area end-->

	</body>
</html>
