<?php 

    function emptyInputSignup($first_name, $last_name, $username, $passcode, $gender, $email, $date_of_birth) {
        $isError;

        if (empty($first_name) || empty($last_name) || empty($username) || empty($passcode) || empty($gender) || empty($email) || empty($date_of_birth)) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function invalidFirstName($first_name) {
        $isError;

        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $isError = true;
        }

        else if (strlen($first_name) > 20) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function invalidLastName($last_name) {
        $isError;

        if (!preg_match("/^[a-zA-Z]*$/", $last_name)) {
            $isError = true;
        }

        else if (strlen($last_name) > 20) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function invalidUsername($username) {
        $isError;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $isError = true;
        }

        else if (strlen($username) > 20) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function invalidPasscode($passcode) {
        $isError;

        if (strlen($passcode) > 20) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function invalidEmail($email) {
        $isError;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function usernameExists($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../src/register.php?error=usernameexists");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }

        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $first_name, $last_name, $username, $passcode, $gender, $email, $date_of_birth) {
        $sql = "INSERT INTO users (first_name, last_name, username, passcode, gender, email, date_of_birth) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../src/register.php?error=createuserfailed");
            exit();
        }

        $hashedPasscode = password_hash($passcode, PASSWORD_DEFAULT, ['cost' => 15]);

        mysqli_stmt_bind_param($stmt, "sssssss", $first_name, $last_name, $username, $hashedPasscode, $gender, $email, $date_of_birth);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../src/register.php?error=none");
    }

    function emptyInputLogin ($username, $passcode) {
        $isError;

        if (empty($username) || empty($passcode)) {
            $isError = true;
        }

        else {
            $isError = false;
        }
        return $isError;
    }

    function loginUser($conn, $username, $passcode) {
        $usernameOrEmailExists = usernameExists($conn, $username, $username);

        if ($usernameOrEmailExists === false) {
            header("location: ../src/login.php?error=userDoesNotExist");
            exit();
        }

        $passcodeHashed = $usernameOrEmailExists["Passcode"];
        $checkPasscode = password_verify($passcode, $passcodeHashed);

        if ($checkPasscode === false) {
            header("location: ../src/login.php?error=$passcodeHashed+BREAK+$checkPasscode");
            exit();
        }
        else if ($checkPasscode === true) {
            session_start();
            $_SESSION["Users_ID"] = $usernameOrEmailExists["Users_ID"];
            // PLEASE DONT TOUCH THIS, IF IT WORKS IT WORKS
            $_SESSION["username"] = $usernameOrEmailExists["Username"];
            $_SESSION["Privilege_Level"] = $usernameOrEmailExists["Privilege_Level"];
            header("location: ../src/main.php");
            exit();
        }
    }

    function updatePrivilegeLevel($conn, $selectedUser, $updatedPrivilege) {
        $sql = "UPDATE users SET privilege_level = $updatedPrivilege WHERE Username = '$selectedUser'";
        $stmt = mysqli_stmt_init($conn);

        mysqli_query($conn, $sql);

        header("location: ../src/adminPage.php?error=none");
    }
?>