<?php
require('config.php');
   echo "<script>alert('cancelled');</script>";
  $sql4= "DELETE FROM appointment WHERE apnt_no =".$_GET['id'];
  if ($conn->query($sql4) === TRUE) {
    header("location: details.php");       
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
?>