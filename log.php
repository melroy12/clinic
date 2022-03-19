<?php
require('config.php');
session_start();

if(isset($_POST['name']))
{
    $name=$_POST['name'];
    $password=$_POST['password'];
    $sql= "SELECT id, password FROM patient WHERE name = '".$name."'and password = '".$password."'limit 1";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1)
    {
      $row=mysqli_fetch_assoc($result)  ;
      $_SESSION['name']=$name;
      //echo $row['id'];
      $_SESSION['id']=$row['id'];
      if($name=='admin' && $password=='Admin@123')
      {
          $_SESSION['name']=$name;
        header("location: admin.php");
      }
      else
      {
        header("location: welcome.php");
      }
    }
     
    else
    {
        // echo "Invalid Username/Password";
        echo "<script>alert('Invalid Username/Password')</script>";
    }
    
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="stylereg.css">
    <title>MED-BAY</title>
    <style>
       body {
      background-image: url('doctorpic.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed; 
      background-size: 100% 100%;
    }
      .navbar-collapse{
        flex-direction: row-reverse;
      }
      .container {
      width: 40%;
      background-color:rgba(8, 8, 8, 0.708);
      color: rgb(245, 234, 234);
      }
      .mt-4, .my-4{
        margin-top:150px!important;
      }
      </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark">
  <img src="main.png" alt="..." style="max-width: 5%;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reg.php">Register</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="log.php">Login</a>
      </li>  
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Please Login Here:</h3>
<hr>

<form action="log.php" method="POST">
  <div class="form-group">
    <label for="inputName">Name</label>
    <input type="text" name="name" class="form-control" id="inputName" aria-describedby="emailHelp" required placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" name="password" class="form-control" id="InputPassword" required placeholder="Enter Password">
  </div>

<div class="form-group">
                <input type="submit" name="loggedin" class="btn btn-primary" value="Log in">
</div>
</form>



</div>

 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>