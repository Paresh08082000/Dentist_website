<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login_dentist.php");
    exit;
}
//Connecting to the Database
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
    // echo "Connection was successful<br>";
}
error_reporting(0);
$user_name = $_SESSION['user_name'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM `dentist` where user_name='".mysqli_escape_string($conn,$user_name)."'";
$result = mysqli_query($conn, $sql);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        .wrapper {
            text-align: center;
            margin: 15px;
        }
        .wrapper #profile_photo {
            border: solid 3px blueviolet;
            margin-right: 580px;
            margin-left: 580px;
            box-shadow: 5px 5px 5px 5px #888888;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 90%;
        border : solid;
        margin:20px;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
        border : solid;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        .button {
            padding: 10px;
            margin-left: 680px;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <div id="college-title">
      <h1 id="college-name">
        <b>Phamoss Pvt. Ltd., Pune</b>
      </h1>
    </div>
    <?php
        while($row = mysqli_fetch_assoc($result)){
    ?> 

        <div class="wrapper">


            <div id="profile_photo" >
                <?php echo "<tr><td><a href='$row[photo]'><img src='".$row['photo']."'height='300' width='300' ></a></td></tr>";?>
            </div>

                <div class="Profile">
                
                    <table>
                        <tr>
                            <td><b>Name</b></td>
                            <td><?php echo $row['user_name'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Clinic Name</b></td>
                            <td><?php echo $row['clinic'] ?></td>
                        </tr>
                        <tr>
                            <td><b>E-Mail ID</b> </td>
                            <td><?php echo $row['email'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Clinic Address</b></td>
                            <td><?php echo $row['address'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Mobile No.</b> </td>
                            <td><?php echo $row['mobile'] ?></td>
                        </tr>
                    </table>
                </div>
                <?php
                 }
                ?>                
        </div>
        <button type="button" class="btn btn-primary button">Buy Products</button>
</body>
</html>