<?php
    session_start();
?>

<header>
    <link href="../css/headerFooterTemplate.css" rel="stylesheet">
    <link href="../css/loginTemplate.css" rel="stylesheet">

    <div class="Header_Upper">
        <div class="main-logo">
            <a href="main.php"><img src="../images/HISS.png" alt="logo" href="#"></a>
        </div>

        <?php
            $welcomeString = "";
            if (isset($_SESSION["username"])) {
                $currentPrivilegeLevel = $_SESSION["Privilege_Level"];
                if ($currentPrivilegeLevel == 3) {
                    echo "<form action='adminPage.php' method='POST' class='privilege'>";
                    echo "<input type='submit' value='Update Privilege'/>";
                    echo "</form>";
                }
            
                //echo $welcomeString;
                echo ("<div class='button-loginRegister'><button onclick=\"signOut()\"> Sign Out </button></div>");
                $welcomeString = "<div class=\"profile\"><p>Welcome " . $_SESSION['username'] . "</p></div>";
                echo $welcomeString;
            }
            else {
                echo ("<div class='button-loginRegister'>");
                echo ("<button onclick=\"signUp()\"> Register Now </button>");
                echo ("<button onclick=\"login()\"> Login Now </button>");
                echo ("</div>");
            }
        ?>

        <script>
            function signOut() {
                window.location.href = "../src/logout.php";
            }

            function signUp() {
                window.location.href = "../src/register.php";
            }

            function login() {
                window.location.href = "../src/login.php";
            }
        </script>
    </div>
    
    <div class="Header_Middle">
        <div class="Nav_Bar">
            <form action="showTime.php" method="POST" role="form" class="Header_Nav">
                <button type="submit">Showtime</button>
            </form>
            <form action="bestOfList.php" method="POST" role="form" class="Header_Nav">
                <button type="submit">Best Of List</button>
            </form>
        </div>
        <div class="Search">
            <form action="bestOfList.php" method="GET" role="form" class="Header_Nav">
                <input type="text" name="movie_name" placeholder="Search Movies"/>
                <input class="Search_Button" type="submit" value="Search"/>
            </form>
        </div>
    </div>

</header>
