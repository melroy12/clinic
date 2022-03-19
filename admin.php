<?php
require('config.php');
session_start();
if(!isset($_SESSION['name']))
{
    header("location: log.php");
}
 $sql= "SELECT * FROM patient";
 $result= mysqli_query($conn,$sql);
if(isset($_POST['addp']))
{
    $id = $_POST['userid'];
    $_SESSION['id']=$id;
    header("location: prescription.php");
}
if(isset($_POST['book']))
{
    $id = $_POST['user_id'];
    $_SESSION['id']=$id;
    header("location: appointment.php");
}
if(isset($_POST['view']))
{
    $id = $_POST['uid'];
    $_SESSION['id']=$id;
    header("location: adview.php");
}
if(isset($_POST['addm']))
{
    
    header("location: medicine.php");
}
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
              <!-- <li class="nav-item">
                <a class="nav-link" aria-current="page" href="adout.php">Home</a>
              </li> -->
              <li class="nav-item active">
                <a href="admin.php" class="nav-link">Admin</a>
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

      <div class="medicine">
        <form action="" method="POST"> 
            <button class="btn btn-success" name="addm" type ="submit"> Add Medicine</button>
        </form>
      </div>

      <div class="container">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      
      <th scope="col">Sex</th>
      <th scope="col">Phone No</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  
  <tbody>
      <?php if(mysqli_num_rows($result)>0){
          while($row= mysqli_fetch_assoc($result))
          {?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              
              <td><?php echo $row['sex']; ?></td>
              <td><?php echo $row['phone']; ?></td>
              <td class="button"> 
                  <form action="" method="POST"> 
                       <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                    <button class="btn btn-success" name="view" type ="submit" > View Details</button>
                   </form>
                  <form action="" method="POST"> 
                      <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <button class="btn btn-success" name="book" type ="submit"> Appointment</button>
                  </form>
                  <form action="" method="POST"> 
                       <input type="hidden" name="userid" value="<?php echo $row['id']; ?>">
                    <button class="btn btn-success" name="addp" type ="submit"> Prescription</button>
                   </form>
             </td>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    


</body>
</html>