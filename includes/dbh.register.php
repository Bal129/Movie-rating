<?php
    include_once '../includes/dbh.connect.php';
?>

<?php 

    if (isset($_POST["submit"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $passcode = $_POST["passcode"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $date_of_birth = $_POST["date_of_birth"];

        require_once 'dbh.connect.php';
        require_once 'dbh.functions.php';

        if (emptyInputSignup($first_name, $last_name, $username, $passcode, $gender, $email, $date_of_birth) !== false) {
            header("location: ../src/register.php?error=emptyInput");
            exit();
        }

        if (invalidFirstName($first_name) !== false) {
            header("location: ../src/register.php?error=invalidFirstName");
            exit();
        }

        if (invalidLastName($last_name) !== false) {
            header("location: ../src/register.php?error=invalidLastName");
            exit();
        }

        if (invalidUsername($username) !== false) {
            header("location: ../src/register.php?error=invalidUsername");
            exit();
        }

        if (invalidPasscode($passcode) !== false) {
            header("location: ../src/register.php?error=invalidPasscode");
            exit();
        }

        if (invalidEmail($email) !== false) {
            header("location: ../src/register.php?error=invalidEmail");
            exit();
        }

        if (usernameExists($conn, $username, $email) !== false) {
            header("location: ../src/register.php?error=usernameTaken");
            exit();
        }

        createUser($conn, $first_name, $last_name, $username, $passcode, $gender, $email, $date_of_birth);
            
    }

    else {

        header("location: ../src/register.php?error");
        exit();
    }

?>