<?php
require('config.php');
session_start();
if(!isset($_SESSION['name']))
{
    echo "errrooor";
    header("location: log.php");
 }
 if(isset($_POST['book']))
 {
    $id= $_GET['id'];
    $apnt_date=$_POST['apnt_date'];
    $apnt_time=$_POST['apnt_time'];   
    $sql= "UPDATE appointment SET apnt_date='$apnt_date', apnt_time='$apnt_time' WHERE apnt_no=$id ";
    $result=mysqli_query($conn,$sql);
    if ($result ==1)
   {
   // echo "New record created successfully";
   header("location: details.php");
   } 
  else 
  {
    echo "<script>alert('$conn->error')</script>" ;
  }
 }

 
 $apnt_no = $_GET["id"];
 $query="SELECT * FROM `appointment` WHERE `apnt_no`=$apnt_no";
 $res1=mysqli_query($conn,$query);
 $row1=mysqli_fetch_array($res1);
 $apnt_date=$row1['apnt_date']; 
 $apnt_time=$row1['apnt_time'];
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
    <script>
      $(document).ready(function){
        $("#apnt_date").datepicker({
          minDate: -2});
        })
      }
    </script>
    <style>
      .navbar-collapse{
        flex-direction: row-reverse;
      }
      </style>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-dark" >
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
        <a class="nav-link" href="logout.php">Logout</a>
      </li>    
     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Update Appointment:</h3>
<hr>

<form action= "" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputDate">Appointment Date :</label>
      <input required type="date" class="form-control" name="apnt_date" id="inputDate" min="<?php echo date("Y-m-d"); ?>" placeholder="Enter Date" value="<?php echo $apnt_date; ?>">
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputTime">Appointment Time</label>
      <input required type="time" class="form-control" name="apnt_time" id="inputTime" placeholder="Enter Time" value="<?php echo $apnt_time; ?>">
    </div>
  
  </div>
  


  <button type="submit" class="btn btn-primary" name="book">BOOK</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>