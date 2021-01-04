<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login_manufacturer.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/Registration.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Add product</title>
</head>
<?php

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];

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
             $sql = "INSERT INTO `products` (`id`, `name`, `price`) VALUES ('$id', '$name', '$price')";
            $result = mysqli_query($conn, $sql);

        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Product has been Added successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          </div>';
        }
        else{
        //     echo "The Student was not Added successfully because of this error ---> ". mysqli_error($conn);
        //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //   <strong>Error!</strong> We are facing some technical issue and your entry was not submitted successfully! We regret the inconvinience caused!
        //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">×</span>
        //   </button>
        // </div>';
        }

      }

    }
  ?>

<body>
<img class="bg" src="img/BG.jpg" alt="background_img">
  <div class="wrapper">
    <div class="title">
      Form
    </div>

    <form class="" action="add_product.php" method="post">
      <div class="form">
      <div class="inputfield">
          <label>ID No.</label>
          <input type="number" name="id" class="input" >
        </div>
        <div class="inputfield">
          <label>Product Name</label>
          <input type="text" name="name" class="input" >
        </div>
        <div class="inputfield">
          <label>Price</label>
          <input type="number" name="price" class="input" >
        </div>
        <div class="inputfield">
          <input type="submit" value="ADD" class="btn" onclick="alert('product added succesfully')">
        </div>
        <div class="inputfield">
            <a href="home_manufacturer.php">
                <input type="button" value="HOME" class="btn" >
            </a>
        </div>
    </form>

  </body>
  <style>
  #college-title {
        margin-top: 10px;
        width: 1430px;
        background-color: #c5d6e5;
        padding: 10px;
        width: 100%;
        }

        #college-name {
          color: #e71919;
          font-size: 3rem;
          line-height: 2rem;
          animation: mymove 10s infinite;
          position: relative;
          text-shadow: 2px 2px 4px #000000; 
        }
        @keyframes mymove {
          from {left: 1200px;;}
          to {left: 75px;;}
        }
  </style>

</html>
