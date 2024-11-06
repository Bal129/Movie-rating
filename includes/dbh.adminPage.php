<?php
    include_once '../includes/dbh.connect.php';
    include_once 'dbh.functions.php';

    if(isset($_POST["submit"])) {
        if ((!empty($_POST["userDropdown"])) AND (!empty($_POST["privilegeDropdown"]))) {
            $selectedOption = $_POST["userDropdown"];

            $selectedUser = strstr($selectedOption, " :", true);

            $updatedPrivilege = $_POST["privilegeDropdown"];

            updatePrivilegeLevel($conn, $selectedUser, $updatedPrivilege);
        }
        
        else {
            header("location: ../src/adminPage.php?error=emptyInput");
            $correctInput = false;
        }
    }

    else {
        header("location: ../src/adminPage.php?error");
        exit();
    }

?>