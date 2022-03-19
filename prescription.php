<?php
require('config.php');
session_start();

if(!isset($_SESSION['name']))
{
    echo "errror";
    header("location: log.php");
 }

//   $_SESSION['id']=$id;

if(isset($_POST['addpresc']))
{
    $id= $_SESSION['id'];
    $mno=$_POST['mno'];
    $dosage=$_POST['dosage'];
    $start=$_POST['start'];
    
    $sql= "INSERT into prescription(id,dosage,start_date)VALUES($id,'$dosage','$start');";       
    // $result=mysqli_query($conn,$sql);
    if ($conn->query($sql) === TRUE) {
      
      // echo "Last rowid is: " . ;
      // echo "record inserted successfully";
      $lastid=$conn->insert_id;
      echo "New record created successfully last id is: " . $lastid;
    }
  else 
  {
    echo "Error1: " . $sql . "<br>" . $conn->error;
  }
    
    // $sql1= "SELECT pno FROM prescription WHERE id=".$id;
    // $result1= mysqli_query($conn,$sql1);
    // if(mysqli_num_rows($result1)>0)
    // {

    //   $row=mysqli_fetch_assoc($result1);
      $pno=$lastid;
      $sql3="INSERT into has(mno,pno)VALUES('$mno',$pno);";
    $result3= mysqli_query($conn,$sql3);
    if ($result3 ==1)
    {
      // echo "New record created successfully";
      header("location: admin.php");
    } 
    else 
    {
        echo "Error2: " . $sql3 . "<br>" . $conn->error;
    }   
      
  // } 
  } 
  $sql11="SELECT mno FROM medicine";
  $result11= mysqli_query($conn,$sql11);
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
        <a class="nav-link" href="logout.php">Logout</a>
      </li>    
     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Prescription:</h3>
<hr>

<form action= "" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputMno">Medicine number :</label> 
      <select name="mno" id=""> 
        <?php
          while($row=mysqli_fetch_assoc($result11))
          {
            echo "<option value=".$row['mno'].">".$row['mno']."</option>";
          }
        ?>
      
      </select>
      <!-- <input required type="text" class="form-control" name="mno" id="inputMno" placeholder="Enter Medicine number"> -->
    </div>
     <div class="form-group col-md-6">
      <label for="inputDosge">Dosage</label> 
      <select name="dosage" id="">
        <option value="0-0-1">0-0-1</option>
        <option value="0-1-0">0-1-0</option>
        <option value="1-0-0">1-0-0</option>
        <option value="0-1-1">0-1-1</option>
        <option value="1-0-1">1-0-1</option>
        <option value="1-1-0">1-1-0</option>
        <option value="1-1-1">1-1-1</option>

      </select>
      <!-- <input required type="text" class="form-control" name ="dosage" id="inputDosage" placeholder="Enter Dosage"> -->
    </div> 
    <div class="form-group col-md-6">
      <label for="inputStart">Start Date</label>
      <input required type="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" name="start" id="inputStart" placeholder="Enter Start Date">
    </div>
   
  </div>
  


  <button type="submit" class="btn btn-primary" name="addpresc">ADD</button>
</form>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>







