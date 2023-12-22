<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '', 'hotnfast');

if (!$con) {
    die("Failed to connect with database: " . mysqli_connect_error());
}

// get the post records
$tablename = "checkout";

// database insert SQL code
$sql = "INSERT INTO $tablename (fullname, email, address, city, zipcode, cardname, cardnumber, expnumber, cvvnumber) 
        VALUES ('$_POST[fullname]','$_POST[email]','$_POST[address]','$_POST[city]','$_POST[zipcode]','$_POST[cardname]','$_POST[cardnumber]','$_POST[expnumber]','$_POST[cvvnumber]')";

// insert in database
$rs = mysqli_query($con, $sql);

if ($rs) {
    
    echo "<script>alert('Your order has been placed successfully!');
    window.location.href='../html/dishes.html';</script>";
} else {
    echo "<script>alert('Your Payment Feild!. Try again!');
    window.location.href='../html/dishes.html';</script>";
}


// close connection
mysqli_close($con);
?>