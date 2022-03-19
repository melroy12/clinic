<?php
require('config.php');
$id=$_POST['pno'];
// if(isset($_POST['cancel'])){
  
  $sql5= "DELETE FROM prescription WHERE pno = ".$id;
  if ($conn->query($sql5) == TRUE) {
//    header("location: adview.php");

        echo "success";
        
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
// }
?>