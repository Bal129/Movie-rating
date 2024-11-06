<?php 

    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "hiss_webapp_database";

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

    // if (!$conn) {
    //     die("Connection failed : " . mysqli_connect_error());
    // }
    // else {
    //     echo "Connection successful!";
    // }
    
?>