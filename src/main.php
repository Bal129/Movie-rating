<!DOCTYPE html>
<html>
    <head>
        <title>HISS Movie Rating Platform</title>
        <link href="../css/mainTemplate.css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php' ?>
        <div class="main-menu-body">
            <div class="what-to-watch">
            <?php 
                require_once "../includes/dbh.connect.php";
                require_once "./segmentCard.php";
                global $conn;
            ?>
            <?php
                $movies = mysqli_query($conn, "SELECT * FROM movies");
                $numOfRow = mysqli_num_rows($movies);
                $LIMIT_PER_PAGE = 3;
                mysqli_free_result($movies);
            ?>

            <h1>What To Watch</h1>
            <?php 
                // Shuffle idea on what to watch
                getBestOfAllTimeData($LIMIT_PER_PAGE, rand(1,$numOfRow/$LIMIT_PER_PAGE));
            ?>
            </div>
            
            <aside>
                <h2>Currently In Cinemas</h2>
                <?php 
                    // Shuffle idea on what to watch
                    getShowTime($LIMIT_PER_PAGE, rand(1,$numOfRow/$LIMIT_PER_PAGE));
                ?>
            </aside>
        </div>
        <?php include 'footer.php'?>
    </body>
</html>