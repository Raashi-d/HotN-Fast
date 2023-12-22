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

         header('Location: ../html/main.html');
         
         
      } 
      else{
        
         echo "<script>alert('You have entered an invalid username or password.');
         window.location.href='../html/login.html';</script>"; 
        }
?> 