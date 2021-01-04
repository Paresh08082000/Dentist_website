<?php
error_reporting(0);
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_name = $_POST["user_name"];
	 // Connecting to the Database
	 $servername = "localhost:3308";
	 $username = "root";
	 $password = "";
	 $database = "dentists";

	  // Create a connection
	  $conn = mysqli_connect($servername, $username, $password, $database);

	  // Die if connection was not successful
	  if (!$conn){
		  die("Sorry we failed to connect: ". mysqli_connect_error());
	  }
	  else{
		$sql = "SELECT * FROM dentist WHERE `user_name`='$user_name'";
		$result = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($result);
	  }
	  if ($num == 1){
		$login = true;
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['user_name'] = $user_name;
		header("location: home_dentist.php");

	}
else{
	echo "<script>alert(\"Search dosen't match with any dentist...try again\");</script>";
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search Docter</title>
	<link rel="stylesheet" href="css/search_styles.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>

<body>
	<img class="bg" src="img/BG.jpg" alt="background_img">

<div class="wrapper">
  <div class="search_box">
      <form action="search.php" method="post">
        <input type="text" name="user_name" placeholder="Search Nearby Dentist...">
        <input class="fa-search" type="submit" value="Search" >
      </form>
      
  </div>
</div>
</body>
</html>