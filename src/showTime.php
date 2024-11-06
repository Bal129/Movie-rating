<!DOCTYPE html>
<html>
    <head>
        <link href="../css/headerFooterTemplate.css" rel="stylesheet">
        <link href="../css/showTimeTemplate.css" rel="stylesheet">
        <script src="../js/bestOfScript.js"></script>
        <title>HISS Movie Rating Platform</title>
    </head>
    <body>
        <?php include 'header.php' ?>
        <?php 
            require_once "../includes/dbh.connect.php";
            require_once "./segmentCard.php";
            global $conn;
        ?>

        <div class="main-body">
            <div class="show-time-main">
                <div class="button-dates">
                    <button onclick="">Mon</button>
                    <button onclick="">Tue</button>
                    <button onclick="">Wed</button>
                    <button onclick="">Thu</button>
                    <button onclick="">Fri</button>
                    <button onclick="">Sat</button>
                    <button onclick="">Sun</button>
                </div>
                <div class="show-time-list">
                    <div class="show-body">
                        <?php
                            $curPage = 1;
                            if (array_key_exists("Cur_Page",$_GET))
                                $curPage = $_GET["Cur_Page"];

                            $movies = mysqli_query($conn, "SELECT * FROM movies");
                            $numOfRow = mysqli_num_rows($movies);
                            $LIMIT_PER_PAGE = 3;
                            mysqli_free_result($movies);
                        ?>
                        <?php 
                            getShowTime($LIMIT_PER_PAGE, $curPage);
                        ?>
                    </div>
                        <form method="GET">
                            <?php
                                for ($i=1; $i <= $LIMIT_PER_PAGE; $i++) { 
                                    echo '<input type="submit" value="'.$i.'" name="Cur_Page" class="button-page">';
                                }
                            ?>
                        </form>
                </div>
            </div>
            <div class="show-time-trendings">
                <div class="show-trendings-movies" id="segment_container">
                    <h2 class="trending-header"> Trendings </h2>
                    <?php 
                        require_once "../includes/dbh.connect.php";
                        require_once "./segmentCard.php";
                        global $conn;
                    ?>
                    <?php 
                    getTrendingData(3,1);
                    ?>
                </div>
            </div>

        </div>
        <?php include 'footer.php' ?>
    </body>
</html>