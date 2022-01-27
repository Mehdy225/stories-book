<?php
session_start();
include 'header.php';


$histoire_id=$_GET['id'];  


    $query = mysqli_query($conn, "DELETE FROM `histoire` WHERE id ='$histoire_id'" );    
  
   
    if (!$query) {   echo "erreur";
      } else {
      header('Location: lire.php');
}

  

?>