<!DOCTYPE html>
<html>
    <head>
        <link href="../css/loginTemplate.css" rel="stylesheet">
        <title>HISS Movie Rating Platform</title>
    </head>
    <body>
        <?php include 'header.php' ?>

        <?php 
            require_once "../includes/dbh.connect.php";
            global $conn;
            if (isset($_POST['email']) && isset($_POST['password'])) {
                echo "<h1>$_POST</h1>";
            }
        ?>

        <div class="container">
            <div class="row">
                <div id="login-box">
                    <div class="login-header"><h2>Login</h2></div>
                    <form role="form" action="../includes/dbh.login.php" method="POST">

                        <div class="form-group has-error">
                            <label>Username/Email</label>
                            <input type="username" class="form-control" name="username" value="">
                        </div>

                        <div class="form-group has-error">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passcode" >
                        </div>

                        <div class="login-buttons">
                            <button type="submit" class="btn-login" name="submit">Login</button>
                        </div>
                    </form>
                    <a href="../src/register.php" class="btn-signup">
                        Sign Up
                    </a>
                    <!-- <button onlick="window.location.href = '../src/register.php'" class="btn-signup">Sign Up</button> -->
                </div>

                <?php 

                    if(isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyInput") {
                            echo "<p>Please fill in all fields!</p>";
                        }
                        else if ($_GET["error"] == "wrongLogin") {
                            echo "<p>Incorrect Login Details</p>";
                        }
                    }

                ?>

            </div>  
        </div>  <!-- end container -->

        <?php include 'footer.php' ?>
    </body>
</html>