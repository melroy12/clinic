<?php
require('config.php');
session_start();
if(!isset($_SESSION['name']))
{
    echo "errrooor";
    header("location: log.php");
 }
 if(isset($_POST['addm']))
 {
    $mno=$_POST['mno'];
    $mname=$_POST['mname'];
    $use=$_POST['use'];
    
    
    $sql= "INSERT into medicine(mno,mname,used_for)VALUES('$mno','$mname','$use');";
    $result=mysqli_query($conn,$sql);
    if ($result ==1)
   {
   // echo "New record created successfully";
   header("location: admin.php");
   } 
  else 
  {
    echo "Error: " . $sql . "<br>" . $conn->error;
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
      .navbar-collapse{
        flex-direction: row-reverse;
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
        <a class="nav-link" href="admin.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
                <a href="details.php" class="nav-link">Apointments</a>
              </li>
      <li class="nav-item">
        <a class="nav-link" href="adout.php">Logout</a>
      </li>    
     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Add Medicine:</h3>
<hr>

<form action= "" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputMno">Medicine Number :</label>
      <input required type="text" class="form-control" name="mno" id="inputMno" placeholder="Enter Medicine Number">
    </div>
    <div class="form-group col-md-6">
      <label for="inputMname">Medicine Name</label>
      <input required type="text" class="form-control" name="mname" id="inputMname" placeholder="Enter Medicine Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputUse">Used For</label>
      <input required type="text" class="form-control" name="use" id="inputUse" placeholder="Enter Use">
    </div>
    
  


  <button type="submit" class="btn btn-primary" name="addm">ADD</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>