<!DOCTYPE html>

<html>
    <head>
        <link href="../css/headerFooterTemplate.css" rel="stylesheet">
        <link href="../css/loginTemplate.css" rel="stylesheet">
        <title>HISS Movie Rating Platform</title>
    </head>
    <body>
        <?php include 'header.php' ?>

        <div class="container">
            <div class="row">
                <div id="login-box">
                    <div class="login-header"><h2>Register</h2></div>

                    <form role="form" action="../includes/dbh.register.php" method="POST">

                        <div class="form-group has-error">
                            <label for="input_First_name">First Name</label>
                            <input type="first_name" class="form-control" name="first_name">                <!-- INPUT -->
                        </div>

                        <div class="form-group has-error">
                            <label for="input_last_name">Last Name</label>
                            <input type="last_name" class="form-control" name="last_name">                  <!-- INPUT -->
                        </div>

                        <div class="form-group has-error">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="username" class="form-control" name="username">                    <!-- INPUT -->
                        </div>

                        <div class="form-group has-error">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="passcode">                    <!-- INPUT -->
                        </div>

                        <div class="form-group has-error">
                            <label>Gender</label><br>
                            <input type="radio" class="form-control-2" name="gender" value="M">            <!-- INPUT -->
                            <label for="radio">Male</label>
                            <input type="radio" class="form-control-2" name="gender" value="F">
                            <label for="radio">Female</label><br>
                        </div>

                        <div class="form-group has-error">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email">                          <!-- INPUT -->
                        </div>

                        <div class="form-group has-error">
                            <label for="input_date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth">                   <!-- INPUT -->
                        </div>

                        <button type="submit" class="btn-login" name="submit">Submit</button>               <!-- SUBMIT -->
                        
                        <div class="login-link">
                            Already have an account 
                            <a href="login.php">Login?</a>
                        </div>

                    </form> 

                </div>

                <?php 

                        if(isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyInput") {
                                echo "<p>Please fill in all fields!</p>";
                            }
                            else if ($_GET["error"] == "invalidFirstName") {
                                echo "<p>Invalid First Name</p>";
                            }
                            else if ($_GET["error"] == "invalidLastName") {
                                echo "<p>Invalid Last Name</p>";
                            }
                            else if ($_GET["error"] == "invalidUsername") {
                                echo "<p>Invalid Username</p>";
                            }
                            else if ($_GET["error"] == "invalidPasscode") {
                                echo "<p>Invalid Password</p>";
                            }
                            else if ($_GET["error"] == "invalidEmail") {
                                echo "<p>Invalid Email</p>";
                            }
                            else if ($_GET["error"] == "usernameTaken") {
                                echo "<p>Username Already Exists</p>";
                            }
                            else if ($_GET["error"] == "none") {
                                echo "<p>Registration Successful!</p>";
                            }
                        }

                    ?>

            </div>
        </div>  <!-- end container -->

        <?php include 'footer.php' ?>
    </body>
</html>