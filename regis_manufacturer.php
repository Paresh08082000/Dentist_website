<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/Registration.css">
  <title>Registration</title>
</head>
<?php

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $password = $_POST['password'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "company_photo/". $filename;
        // move the image from php temparory folder to our local folder
        move_uploaded_file($tempname,$folder);

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
           // Submit these to a database
           // Sql query to be executed
             $sql = "INSERT INTO `manufacturer` (`photo`, `name`, `password`, `email`, `mobile`, `address`) VALUES ('$folder', '$company', '$password', '$email', '$mobile', '$address')";
            $result = mysqli_query($conn, $sql);

        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You have registered successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          </div>';
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry was not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }

      }

    }
  ?>

<body>
<img class="bg" src="img/BG.jpg" alt="background_img">
  <div class="wrapper">
    <div class="title">
      Registration Form
    </div>

    <form class="" action="regis_manufacturer.php" method="post" enctype="multipart/form-data">
      <div class="form">
      <div class="inputfield">
          <label>Company photo</label>
          <input type="file" name="uploadfile" value="" class="input">
        </div>
        <div class="inputfield" >
          <label>Company Name</label>
          <input type="text" name="company" class="input">
        </div>
        <div class="inputfield">
          <label>Password</label>
          <input type="password" name="password" class="input" >
        </div>
        
        <div class="inputfield" >
          <label>Email Address</label>
          <input type="email" name="email" class="input">
        </div>
        <div class="inputfield">
          <label>Mobile Number</label>
          <input type="number" class="input" name="mobile" >
        </div>
        <div class="inputfield">
          <label>Company Address</label>
          <textarea class="textarea" name="address" ></textarea>
        </div>
        <div class="inputfield">
          <input type="submit" value="Register" class="btn">
        </div>
        <div class="inputfield">
          <input type="button" value="Go Back" onclick="history.back()" class="btn">
        </div>
    </form>

  </body>

</html>
