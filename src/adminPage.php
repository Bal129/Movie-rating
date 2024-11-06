<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../css/adminPageTemplate.css" rel="stylesheet">
    <title>HISS Movie Rating Platform</title>
</head>
<body>
    <?php 
        include 'header.php';
        include "../includes/dbh.connect.php";
        global $conn;
    ?>

    <div class ="main-body">
        <form action="../includes/dbh.adminPage.php" class="dropdown" method="POST">
            <select title="dropdown1" name="userDropdown" class="dropbtn userDropdown" onchange="chooseUserFunction(this)">
                <option value="" selected disabled hidden> Select User</option>
                <?php 
                    $queryUserList = mysqli_query($conn, "SELECT * FROM users");
                    while ($currentUser = mysqli_fetch_array($queryUserList)) {
                        $usernameCycle = $currentUser["Username"];
                        $privilegeCycle = $currentUser["Privilege_Level"];

                        if($privilegeCycle == 1) {
                            $privilegeCycle = "Level 1 - User";
                        }
                        elseif($privilegeCycle == 2) {
                            $privilegeCycle = "Level 2 - Moderator";
                        }
                        elseif($privilegeCycle == 3) {
                            $privilegeCycle = "Level 3 - Admin";
                        }

                        $optionCycle = $usernameCycle . " : " . $privilegeCycle;

                        echo "<option value =\"$optionCycle\"> $optionCycle </option>";
                    }
                ?>
            </select>

            <select title="dropdown2" name="privilegeDropdown" class="dropbtn privilegeDropdown" onchange="choosePrivilegeFunction(this)">
                    <option value="" selected disabled hidden> Select Privilege Level </option>
                    <option value="1">Level 1 - User</option>
                    <option value="2">Level 2 - Moderator</option>
                    <option value="3">Level 3 - Admin</option>
            </select>

            <hr>
            <br>

            <h3>Selected User :</h3>

            <br>

            <p id="selectedUsername">No User Selected</p>

            <br>

            <h3>Change Privilege Level To :</h3>

            <br>

            <p id="selectedPrivilegeLevel">No Privilege Level Selected</p>

            <br>

            <button type="submit" class="btn-login" name="submit">Submit</button> 
        </form>

        <?php 
            if(isset($_GET["error"])) {
                if ($_GET["error"] == "emptyInput") {
                    echo "<hr>";
                    echo "<p>Please select both a user and a new privilege level!</p>";
                }
                
                elseif ($_GET["error"] == "none") {
                    echo "<hr>";
                    echo "<p>Update Successful!</p>";
                }
            }
        ?>
    </div>

    <script>
        function chooseUserFunction(select) {
            var selectedUsername = select.options[select.selectedIndex].text;
            document.getElementById("selectedUsername").innerHTML = selectedUsername;
        }

        function choosePrivilegeFunction(select) {
            document.getElementById("selectedPrivilegeLevel").innerHTML = select.options[select.selectedIndex].text;
        }
    </script>

    <?php include 'footer.php'?>
</body>
</html>