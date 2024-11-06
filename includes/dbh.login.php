<?php 

    if (isset($_POST["submit"])) {

        $username = $_POST["username"];
        $passcode = $_POST["passcode"];

        require_once "dbh.connect.php";
        require_once "dbh.functions.php";

        if (emptyInputLogin($username, $passcode) !== false) {
            header("location: ../src/login.php?error=emptyInput");
            exit();
        }

        loginUser($conn, $username, $passcode);

    }

    else {
        header("location: ../src/login.php?error");
        exit();
    }

?>