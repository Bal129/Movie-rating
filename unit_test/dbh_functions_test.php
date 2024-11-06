<?php
    require_once "../includes/dbh.connect.php";
    require_once "../includes/dbh.functions.php";

    global $conn;

    $stub = array(
        "first_name"    => "test",
        "last_name"     => "test",
        "username"      => "test",
        "passcode"      => "test",
        "gender"        => "test",
        "email"         => "test@gmail.com",
        "date_of_birth" => 2001-01-01
    );


    ////////////////// TEST FOR emptyInputSignup

    ////////// return TRUE when first_name is empty
    if (emptyInputSignup("", $stub["last_name"], $stub["username"], $stub["passcode"], $stub["gender"], $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.first_name.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.first_name.empty FAILED</h3><br>";

    ////////// return TRUE when last_name is empty
    if (emptyInputSignup($stub["first_name"], "", $stub["username"], $stub["passcode"], $stub["gender"], $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.last_name.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.last_name.empty FAILED</h3><br>";

    ////////// return TRUE when username is empty
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], "", $stub["passcode"], $stub["gender"], $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.username.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.username.empty FAILED</h3><br>";

    ////////// return TRUE when passcode is empty
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], $stub["username"], "", $stub["gender"], $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.passcode.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.passcode.empty FAILED</h3><br>";

    ////////// return TRUE when gender is empty
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], $stub["username"], $stub["passcode"], "", $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.gender.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.gender.empty FAILED</h3><br>";

    ////////// return TRUE when email is empty
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], $stub["username"], $stub["passcode"], $stub["gender"], "", $stub["date_of_birth"]))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.email.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.email.empty FAILED</h3><br>";

    ////////// return TRUE when date_of_birth is empty
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], $stub["username"], $stub["passcode"], $stub["gender"], $stub["email"], ""))
        echo "<h3 style='color:green;'>TEST emptyInputSignup.date_of_birth.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST emptyInputSignup.date_of_birth.empty FAILED</h3><br>";

    ////////// return FALSE when all data filled up
    if (emptyInputSignup($stub["first_name"], $stub["last_name"], $stub["username"], $stub["passcode"], $stub["gender"], $stub["email"], $stub["date_of_birth"]))
        echo "<h3 style='color:red;'>TEST emptyInputSignup.not.empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST emptyInputSignup.not.empty SUCCESSFULLY</h3><br>";


    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return TRUE when first_name is empty
    if (invalidFirstName(""))
        echo "<h3 style='color:green;'>TEST invalidFirstName.first_name.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidFirstName.first_name.empty FAILED</h3><br>";

    ////////// return TRUE when first_name exceed 20 char
    if (invalidFirstName("abcdefghijklmnopqrstuvwxyz"))
        echo "<h3 style='color:green;'>TEST invalidFirstName.first_name.exceed_20_char SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidFirstName.first_name.exceed_20_char FAILED</h3><br>";

    ////////// return FALSE when first_name is not empty
    if (invalidFirstName($stub["first_name"]))
        echo "<h3 style='color:red;'>TEST invalidFirstName.first_name.not_empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST invalidFirstName.first_name.not_empty SUCCESSFULLY</h3><br>";

    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return TRUE when last_name is empty
    if (invalidLastName(""))
        echo "<h3 style='color:green;'>TEST invalidLastName.last_name.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidLastName.last_name.empty FAILED</h3><br>";

    ////////// return TRUE when last_name exceed 20 char
    if (invalidLastName("abcdefghijklmnopqrstuvwxyz"))
        echo "<h3 style='color:green;'>TEST invalidLastName.last_name.exceed_20_char SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidLastName.last_name.exceed_20_char FAILED</h3><br>";
  
    ////////// return FALSE when last_name is not empty
    if (invalidLastName($stub["last_name"]))
        echo "<h3 style='color:red;'>TEST invalidLastName.last_name.not_empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST invalidLastName.last_name.not_empty SUCCESSFULLY</h3><br>";

    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return TRUE when username is empty
    if (invalidUsername(""))
        echo "<h3 style='color:green;'>TEST invalidUsername.username.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidUsername.username.empty FAILED</h3><br>";

    ////////// return TRUE when username exceed 20 char
    if (invalidUsername("abcdefghijklmnopqrstuvwxyz"))
        echo "<h3 style='color:green;'>TEST invalidUsername.username.exceed_20_char SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidUsername.username.exceed_20_char FAILED</h3><br>";

    ////////// return FALSE when username is not empty
    if (invalidUsername($stub["username"]))
        echo "<h3 style='color:red;'>TEST invalidUsername.username.not_empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST invalidUsername.username.not_empty SUCCESSFULLY</h3><br>";

    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return TRUE when passcode is empty
    if (invalidPasscode(""))
        echo "<h3 style='color:green;'>TEST invalidPasscode.passcode.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidPasscode.passcode.empty FAILED</h3><br>";
  
    ////////// return FALSE when passcode is not empty
    if (invalidPasscode($stub["passcode"]))
        echo "<h3 style='color:red;'>TEST invalidPasscode.passcode.not_empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST invalidPasscode.passcode.not_empty SUCCESSFULLY</h3><br>";

    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return TRUE when email is empty
    if (invalidEmail(""))
        echo "<h3 style='color:green;'>TEST invalidEmail.email.empty SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidEmail.email.empty FAILED</h3><br>";

    ////////// return TRUE when email is not valid format
    if (invalidEmail("email"))
        echo "<h3 style='color:green;'>TEST invalidEmail.email.not_valid_format SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST invalidEmail.email.not_valid_format FAILED</h3><br>";
  
    ////////// return FALSE when email is not empty
    if (invalidEmail($stub["email"]))
        echo "<h3 style='color:red;'>TEST invalidEmail.email.not_empty FAILED</h3><br>";
    else
        echo "<h3 style='color:green;'>TEST invalidEmail.email.not_empty SUCCESSFULLY</h3><br>";
  
    ////////////////////////////////////////////////////////////////////////////////////////////////

    ////////// return FALSE when email already exist
    if (!empty(usernameExists($conn, "newUSERNAME", "jacqueline.woods@example.com")))
        echo "<h3 style='color:green;'>TEST usernameExists.email.already_exist SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST usernameExists.email.already_exist FAILED</h3><br>";

    ////////// return FALSE when username already exist
    if (!empty(usernameExists($conn, "FunkyMonkey", "newEMAIL@gmail.com")))
        echo "<h3 style='color:green;'>TEST usernameExists.username.already_exist SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST usernameExists.username.already_exist FAILED</h3><br>";

    ////////// return TRUE when email & username are unique
    if (empty(usernameExists($conn, "newUSERNAME", "newEMAIL@gmail.com")))
        echo "<h3 style='color:green;'>TEST usernameExists.new SUCCESSFULLY</h3><br>";
    else
        echo "<h3 style='color:red;'>TEST usernameExists.new FAILED</h3><br>";
?>