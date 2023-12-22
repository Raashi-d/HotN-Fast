<?php
    $fname = $_POST['fname'];
    $Uname = $_POST['Uname'];
    $Email = $_POST['Email'];
    $Pnumber = $_POST['Pnumber'];
    $pword = $_POST['pword'];
    $Confirmpw = $_POST['Confirmpw'];
    $gender = $_POST['gender'];

    
if (!empty($fname) || !empty($Uname) || !empty($Email) || !empty($Pnumber) || !empty($pword) || !empty($Confirmpw) || !empty($gender)) 
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "hotnfast";

    //Database connection

    $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);

    if(mysqli_connect_error()){
        die('Connect error: ' . mysqli_connect_errno().') '. mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT Email FROM register WHERE Email = ? Limit 1";
        $INSERT = "INSERT Into register ( fname, Uname, Email, Pnumber, pword, Confirmpw, gender)
         values ( ?, ?, ?, ?, ?, ?, ?)";
    
    //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
    
        if ($rnum==0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssisss", $fname, $Uname, $Email, $Pnumber, $pword, $Confirmpw, $gender);
            $stmt->execute();

            echo "<script>alert('You have registered successfully.');
            window.location.href='../html/login.html';</script>";

           } else {
            echo "<script>alert('Someone has already registered using this email!');
            window.location.href='../html/registration.html';</script>";
           }
            $stmt->close();
            $conn->close();

    }
} else {
    echo "All field are required";
    die();
   }   

?>