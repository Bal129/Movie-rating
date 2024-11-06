<?php
    require_once "../includes/dbh.connect.php";
    
    global $conn;
    if (!$conn) {
        die("Connection failed : " . mysqli_connect_error());
    }
    else {
        echo "Connection successful!";
    }
?>

