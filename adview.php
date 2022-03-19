<?php
require('config.php');
session_start();
if(!isset($_SESSION['name']))
{
    header("location: log.php");
} 
 $id=$_SESSION['id'];
 $sql1= "SELECT * FROM patient WHERE id=".$id;
 $result1= mysqli_query($conn,$sql1);

 $sql2= "SELECT * FROM medicine m, prescription p, has h WHERE m.mno=h.mno and h.pno= p.pno and p.id=".$id;
 $result2=mysqli_query($conn,$sql2);
 $sql3="SELECT * FROM appointment WHERE id=".$id;
 $result3=mysqli_query($conn,$sql3);
 $sql7= "SELECT * FROM appointment a INNER JOIN  patient p ON p.id=a.id" ;
$result7=mysqli_query($conn,$sql7);
 if(isset($_POST['cancel'])){
   echo "<script>alert('cancelled');</script>";

}
if(isset($_POST['delete'])){
  echo "<script>alert('deleted');</script>";
 
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
      <div class="container-1">
          <?php if(mysqli_num_rows($result1)>0){
              if($row1=mysqli_fetch_assoc($result1)){?>
           <p><b>Id : </b><?php echo $row1['id']; ?> </p>
          <p><b>Name : </b><?php echo $row1['name']; ?> </p>
          <?php }} ?>
         
          
      </div>

      <div class="container">
          <p><b>PRESCRIPTION:</b></p>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Medicine Number</th>
      <th scope="col">Medicine Name</th>
      <th scope="col">Dosage</th>
      <th scope="col">Start Date</th>
      <!-- <th scope="col">End Date</th> -->
      <!-- <th scope="col">Active</th> -->
    </tr>
  </thead>
  
  <tbody>
      <?php if(mysqli_num_rows($result2)>0){
          while($row2= mysqli_fetch_assoc($result2))
          {?>
            <tr>
              <td><?php echo $row2['mno']; ?></td>
              <td><?php echo $row2['mname']; ?></td>
              <td><?php echo $row2['dosage']; ?></td>
              <td><?php echo $row2['start_date']; ?></td>
              <td> 
                <!-- <form action="" method="POST">  -->
                      <!-- <input type="hidden" name="user_id" value="<php echo $row['id']; ?>"> -->
                    <button class="btn btn-success" name="delete" onclick="deletePresc('<?php echo $row2['pno']; ?>')"> Delete Prescription</button>
                  <!-- </form> -->
                 
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
<!-- appointment table -->
<div class="container">
          <p><b>APPOINTMENT:</b></p>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Appointment Number</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Appointment Time</th>
      <th scope="col">Action</th>
      
      <!-- <th scope="col">Active</th> -->
    </tr>
  </thead>
  
  <tbody>
      <?php if(mysqli_num_rows($result3)>0){
          while($row3= mysqli_fetch_assoc($result3))
          {?>
            <tr>
              <td><?php echo $row3['apnt_no']; ?></td>
              <td><?php echo $row3['apnt_date']; ?></td>
              <td><?php echo $row3['apnt_time']; ?></td>
              <td> 
                 <button class="btn btn-success" name="cancel" onclick="cancelAppointment(<?php echo $row3['apnt_no']; ?>)"> Cancel Appointment</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  function cancelAppointment(id){
  // var id = $(this).data('id');
  // var url = "adview.php?id="+id;
  // window.location.href = url;
  $.ajax({
    url: "cancelappointment.php",
    type: "POST",
    data: {
      id: id,
      // cancel: 1
    },
    success: function(){
      alert("Appointment Cancelled");
      window.location.href = "adview.php";
    },
    error: function(){
      alert("Error");
    }
  });
}
</script>
<script>
  function deletePresc(id){
  // var id = $(this).data('id');
  // var url = "adview.php?id="+id;
  // window.location.href = url; 
  console.log(id)
  $.ajax({
    url: "deletePresc.php",
    type: "POST",
    data: {
      pno: id,
      // cancel: 1
    },
    success: function(){
      alert("Prescription deleted");
      window.location.href = "adview.php";
    },
    error: function(){
      alert("Error");
    }
  });
}
</script>






    

</body>
</html>