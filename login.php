<?php
   $host = "localhost";
   $dbusername = "root";
   $dbpassword = "";
   $dbname = "hotnfast";

   //Database connection

   $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);


      $Email = $_POST['Email'];
      $pword=$_POST['pword'];
     
      $result=mysqli_query($conn,"SELECT * FROM register WHERE Email= '$Email' and pword= '$pword'");
      $test=mysqli_fetch_array($result);
      $rows=mysqli_num_rows( $result);
      if($rows>0){

         header('Location:index.html');
         
         
      } 
      else{
        
        $alert = "<script>alert('You have entered invalid username or password');</script>";
            echo $alert;
         exit();
        }
?> 