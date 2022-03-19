<?php
require('config.php');
// if(isset($_POST['cancel'])){
   echo "<script>alert('cancelled');</script>";
  $sql4= "DELETE FROM appointment WHERE apnt_no =".$_POST['id'];
  if ($conn->query($sql4) === TRUE) {
//    header("location: adview.php");

        echo "success";
        
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
// }
?>