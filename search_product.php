<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login_teacher.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .bs-example {
      margin: 20px;
    }
  </style>
</head>


<body>
<div id="college-title">
    <h1 id="college-name">
      <b>Phamoss Pvt. Ltd., Pune</b>
    </h1>
  </div>
  <div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a href="home_manufacturer.php" class="navbar-brand">
      <img src="img/logo.jpg" alt="PCET Trust Logo" style="width:80px; height:75px; margin:0px 10px">
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav">
          <a href="add_product.php" class="nav-item nav-link ">Add Product</a>>
          <a href="search_product.php" class="nav-item nav-link">Search Product</a>
          <a href="delete_product.php" class="nav-item nav-link">Delete Product</a>
          <a href="update_product.php" class="nav-item nav-link">Update Product</a>
        </div>
        <div class="navbar-nav ml-auto">
        <a href="login_manufacturer.php" class="nav-item nav-link">Logout</a>
        </div>
      </div>
    </nav>
    <?php echo "<div id='name'> Company Name: ". $_SESSION['company'].
          "</div>";?>
          <p>Write name of product you want to search</p>
        <form  class="search" action="search_student.php" method="post">
            <input type="text" name="name" placeholder="Product Name"><br><br>
            <input type="submit" name="search" value="Search">
        </form>
   
      <div class="student-heading" >
        Products List
      </div>

        <table>
            <tr>
            <th>ID No.</th>
            <th>Product Name</th>
            <th>Price</th>
            </tr>
            <?php
            if(isset($_POST['search']))
            {
                    // Connecting to the Database
                $servername = "localhost:3308";
                $username = "root";
                $password = "";
                $database = "manufacturers";
                $name=$_POST['name'];

                // Create a connection
                $conn = mysqli_connect($servername, $username, $password, $database);
                // Die if connection was not successful
                if (!$conn){
                    die("Sorry we failed to connect: ". mysqli_connect_error());
                }
                else{
                    // echo "Connection was successful<br>";
                }

                $sql = "SELECT * FROM `products` WHERE `name`='$name'";
                $result = mysqli_query($conn, $sql);

                // Display the rows returned by the sql query
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['price'].'</td></tr>';
                    }
            }
            
            ?>
        </table>

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
          font-size: 3.2rem;
          line-height: 2rem;
          animation: mymove 10s infinite;
          position: relative;
          text-shadow: 2px 2px 4px #000000; 
        }
        @keyframes mymove {
          from {left: 1200px;;}
          to {left: 75px;;}
        }
        .bs-example {
          background-color: #e9ecef;
          margin-top: 5px;
        }
        #name {
          text-align : right;
          margin : 15px;
          font-size : 20px;
          font-weight : bold;
          background-color: aliceblue;
          margin-left: 1150px;
          padding: 5px;
          border: solid blue;
          border-radius: 12px;
        }
        p {
          font-weight: bold;
          text-align: center;
          font-size: 20px;
        }
        .search {
            text-align : center;
            border: solid;
            margin: 20px 500px;
            padding: 20px;
            border-color: black;
            border-width: thick;
            background-color: rgb(145 197 254 / 90%);
            border-radius: 20px;
        }
        .bs-example .student-heading {
          text-align: center;
          font-weight: bolder;
          font-size: 50px;
          margin: 30px 550px;
          background-color: #8807ff;
          border-radius: 40px;
          color: white;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        #id {
        text-align:center;
        }
    </style>

  <hr>
</body>

</html>
