<!DOCTYPE html>
<html>
    <head>
        <title>HISS Movie Rating Platform</title>
        <link href="../css/BestTemplate.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <?php 
                include "header.php";
                require_once "../includes/dbh.connect.php";
                require_once "./segmentCard.php";
                global $conn;
            ?>
        </header>

        <!-- Main Body -->
        <div class="Best_Of_List">
            <div class="Best_Of_List_Nav_Bar">
                <!-- CHANGE CSS HERE FROM BUTTON TO INPUT:SUBMIT -->
                <form method="GET">
                    <input type="submit" value="Trending" name="Best_Of">
                    <input type="submit" value="New Release" name="Best_Of">
                    <input type="submit" value="Upcoming" name="Best_Of">
                    <input type="submit" value="Recent Updates" name="Best_Of">
                </form>
            </div>
            <div class="Best_Of_List_Content">
                <div class="Best_Of_List_Filter">
                    <button onclick="filterSelection('all')">Filters</button>
                </div>
                <!-- Hidden Container Drop Down -->
                <div class="Best_Of_List_Filter_Container">
                </div>
                <div id="segment_container">
                    <?php
                        $movies = mysqli_query($conn, "SELECT * FROM movies");
                        $numOfRow = mysqli_num_rows($movies);
                        $LIMIT_PER_PAGE = 3;
                        mysqli_free_result($movies);
                    ?>

                    <?php
                        $curPage = 1;
                        if (array_key_exists("Cur_Page",$_GET))
                            $curPage = $_GET["Cur_Page"];

                        if (array_key_exists("movie_name",$_GET) && $_GET["movie_name"])
                            getSpecificData($_GET["movie_name"]);
                        else if(array_key_exists("Best_Of",$_GET)){
                            // Trending SORT by Star
                            if ($_GET["Best_Of"] == "Trending")
                                getTrendingData($LIMIT_PER_PAGE, $curPage);
                            // New Release SORT Date of Release 
                            elseif ($_GET["Best_Of"] == "New Release")
                                getNewReleaseData($LIMIT_PER_PAGE, $curPage);
                            // Upcoming SORT from current date onwards
                            elseif ($_GET["Best_Of"] == "Upcoming")
                                getUpcomingData($LIMIT_PER_PAGE, $curPage);
                            // DEFAULT SORT by Recent Updates
                            else 
                                getDefaultData($LIMIT_PER_PAGE, $curPage);
                        }

                        // No Cur_Page SORT by Recent Updates
                        else
                            getDefaultData($LIMIT_PER_PAGE, $curPage);
                    ?>
                </div>

                <form method="GET">
                    <?php
                        if(!(array_key_exists("movie_name",$_GET) && $_GET["movie_name"])) {
                            for ($i=1; $i <= $LIMIT_PER_PAGE; $i++) { 
                                echo '<input type="submit" value="'.$i.'" name="Cur_Page" class="button-page">';
                            }
                        }
                    ?>
                </form>

            </div>
        </div>
        
        <?php include "footer.php" ?>
    </body>

</html>