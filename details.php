<?php
date_default_timezone_set("Asia/Calcutta");
require('config.php');
session_start();
//get current date and time using date()
//this date and time shld be same format as of database
//select everythng from appointment table databse 
if(!isset($_SESSION['name']))
{
    header("location: log.php");
} 

$sql7= "SELECT * FROM appointment a INNER JOIN  patient p ON p.id=a.id" ;
$result7=mysqli_query($conn,$sql7);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MED-BAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="stylereg.css">
    <style>
      .navbar-collapse{
        flex-direction: row-reverse;
      }
      </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
        <img src="main.png" alt="..." style="max-width: 5%;">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="admin.php">Home</a>
              </li>
              <li class="nav-item">
                <a href="details.php" class="nav-link">Apointments</a>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link">Logout</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      
    
      <div class="container">
      <table class="table">
 
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>   
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
      <?php if(mysqli_num_rows($result7)>0){
          while($row7= mysqli_fetch_assoc($result7))
          {
            $dateTime= $row7['apnt_date']." ".$row7['apnt_time'];
            $appntTime = strtotime($dateTime);
            $crntTime = time();
            $status = '';
            if((int)$appntTime > (int)$crntTime){
                $status =  '<span style="background-color:#00f; border-radius:10px; color:#fff; padding:3px" >Upcoming</span>';
            }else{ 
                $status = '<span style="background-color:#f00; border-radius:10px; color:#fff; padding:3px" >Completed</span>';
            }
            ?>

         
            <tr>

              <td><?php echo $row7['id']; ?></td>
              <td><?php echo $row7['name']; ?></td>
              <td><?php echo $row7['apnt_date']; ?></td>
              <td><?php echo date('h:i a',strtotime($row7['apnt_time'])); ?></td>
              <td> 
                <?php echo $status; ?></td>
              <td><?php echo '<a href="delete.php?id='. $row7['apnt_no'] .'"  class="btn btn-success ">Delete</a>';?></td>
              <td><?php echo '<a href="updateapp.php?id='. $row7['apnt_no'] .'"  class="btn btn-success">Update</a>';?></td>
              
            </tr>
         <?php } }
         else
         {
             echo "No records found";
         }                        
         ?> 
  </tbody>
</table>

  

</div>

      
