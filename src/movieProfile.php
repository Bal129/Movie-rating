<!DOCTYPE html>
<html>
    <head>
        <link href="../css/headerFooterTemplate.css" rel="stylesheet">
        <link href="../css/profileTemplate.css" rel="stylesheet">
        <title>HISS Movie Rating Platform</title>
    </head>
    <body>
        <?php include 'header.php' ?>
        <?php // movies
            require_once "../includes/dbh.connect.php";
            require_once "./segmentCard.php";
            global $conn;
            global $currentMovieID;
            global $currentUserID;
            global $currentComment;
            global $createComment;
            global $currentPrivilegeLevel;
            // global $currentMovie = $_GET[];

            // echo "[ DEBUG ]";
            // echo json_encode($_GET);
            // echo json_encode($_SESSION);
            // echo "[ DEBUG ] <br>";
            
            if (!isset($_GET["MOVIES_ID"])) {
                header("location: ../src/bestOfList.php");
            }
            if (isset($_SESSION["username"])) {
                $currentUserID = $_SESSION["Users_ID"];
                $currentPrivilegeLevel = $_SESSION["Privilege_Level"];
            } // get guest id / login whatever because error to go movie profile if no login
            else {
                $currentUserID = -1;
            }
            if (empty($_GET)) {
                $currentMovieID = 1;
            } else {
                $currentMovieID = $_GET['MOVIES_ID'];
            }

            $selectCurrentMovie = "SELECT * FROM movies WHERE Movies_ID = ".$currentMovieID.";";
            $queryCurrentMovie = mysqli_query($conn, $selectCurrentMovie);
            $queryCurrentMovieSynopsis = mysqli_query($conn, $selectCurrentMovie);
            $resultCurrentMovie = mysqli_num_rows($queryCurrentMovie);

        ?>

        <?php  // review
            $selectReview = "SELECT * FROM reviews WHERE Movies_ID = ".$currentMovieID.";";
            $queryReview = mysqli_query($conn, $selectReview);
            $queryReviewComment = mysqli_query($conn, $selectReview);
            $resultReview = mysqli_num_rows($queryReview);
        ?>

        <?php  // your review
            $selectYourReview = "SELECT * FROM reviews WHERE Movies_ID = ".$currentMovieID." AND users_id = ".$currentUserID.";";
            $queryYourReview = mysqli_query($conn, $selectYourReview);
            $resultYourReview = mysqli_num_rows($queryYourReview);
        ?>

        <?php  // genres
            $selectGenre = "SELECT * FROM genres, movies, movie_genres WHERE (movies.Movies_ID = ".$currentMovieID." AND movies.Movies_ID = movie_genres.Movies_ID AND movie_genres.Genres_ID = genres.Genres_ID);";
            $queryGenre = mysqli_query($conn, $selectGenre);
            $resultGenre = mysqli_num_rows($queryGenre);
        ?>

        <?php 
            // production production companies && movie producers
            // movies -> movie_producers -> production_companies
            $selectProduction = "SELECT * FROM movies, movie_producers, production_companies WHERE (movies.Movies_ID= ".$currentMovieID." AND movies.Movies_ID = movie_producers.Movies_ID AND movie_producers.production_companies_id = production_companies.production_companies_id);";
            $queryProduction = mysqli_query($conn, $selectProduction);
            $resultProduction = mysqli_num_rows($queryProduction);
        ?>

        <?php
            // comments roles && actor
            // movies -> roles -> actors
            $selectActor = "SELECT * FROM movies, roles, actors WHERE (movies.Movies_ID = ".$currentMovieID." AND movies.Movies_ID = roles.movies_id AND roles.Actors_ID = actors.actors_id)";
            $queryActor = mysqli_query($conn, $selectActor);
            $resultActor = mysqli_num_rows($queryActor);
        ?>

        <div class="main-body">
            <div class="body-upper">
                    <?php
                    if ($resultCurrentMovie > 0) {
                        while ($row = mysqli_fetch_assoc($queryCurrentMovie)) {
                            $releaseYear = date("Y", strtotime($row['Date_Of_Release']));
                            echo "<h1>".$row['Movies_Title']."</h1>";
                            echo "<h3>".$releaseYear." Release Year </h3>";
                        }
                    }
                    ?>
            </div>
            <div class="body-middle">
                <div class="middle-cover">
                    <div><img src=<?php echo getImage($_GET["MOVIES_ID"]) ?> alt="Movie Cover" class="profile-image"></div>
                </div>
                <div class="middle-rating">
                    <div class="middle-rating-container">
                        <div class="middle-rating-hiss">
                            <p>Hiss Rating <br>
                                <img src="../images/hiss-star-rating.png" alt="Yellow Star: " class="yellow-star">
                                <?php
                                if ($resultReview > 0) {
                                    $averageRating = 0;
                                    while ($row = mysqli_fetch_assoc($queryReview)) {
                                        $averageRating += $row['Stars'];
                                    }
                                    echo number_format(($averageRating / $resultReview), 2);
                                } else {
                                    echo 0;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="middle-rating-your">
                            <p>Your Rating<br>
                                <img src="../images/your-star-rating.png" alt="White Star: " class="white-star">
                                <?php
                                if ($currentUserID != -1) {
                                    if ($resultYourReview > 0) {
                                        $createComment = 2;
                                        while ($rating = mysqli_fetch_assoc($queryYourReview)) {
                                            $currentComment = $rating['Review_Content'];
                                            echo $rating['Stars'];
                                        }
                                    } else {
                                        echo "n/a";
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="middle-synopsis">
                    <div><p><h4>Synopsis</h4>
                        <?php
                        if ($resultCurrentMovie > 0) {
                            while ($row = mysqli_fetch_assoc($queryCurrentMovieSynopsis)) {
                                echo "<p>".$row['Movies_Synopsis']."</p>";
                            }
                        }
                        ?>
                    </p></div>
                </div>
                <div class="middle-genre">
                    <?php
                        if ($resultGenre > 0) {
                            while($row = mysqli_fetch_assoc($queryGenre)) {
                                echo '<p class="genre">'.$row['Genres_Name'].'</p>';
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="body-bottom">
                <div class="bottom-details">
                    <p><h4>Producers:</h4>
                    <?php
                        if ($resultProduction > 0) {
                            echo '<ul>';
                            while($row = mysqli_fetch_assoc($queryProduction)) {
                                echo '<li>'.$row['Company_Name'].'</li>';
                            }
                            echo '</ul>';
                        } else 
                    ?>
                    </p>
                </div>
                <div class="bottom-details">
                    <p><h4>Actors:</h4>
                    <?php
                        if ($resultActor > 0) {
                            echo '<ul>';
                            while($row = mysqli_fetch_assoc($queryActor)) {

                                echo '<li>'.$row['First_Name']." ".$row['Last_Name']." as ".$row['Roles'].'</li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                    </p>
                </div>
                <div class="bottom-review">
                    <p><h4>Reviews</h4></p>
                    <?php // check user id with session id

                        if ($resultYourReview <= 0) {
                            $createComment = 1;
                            $currentComment = "";
                            $rating = 0;
                        }


                        $thisStarRating = 0;
                        $starQuery = mysqli_query($conn, "SELECT Stars from reviews WHERE Movies_ID=".$_GET["MOVIES_ID"]." AND Users_ID=".$currentUserID);
                        while ($starRating = mysqli_fetch_assoc($starQuery)) {
                            $thisStarRating = $starRating['Stars'];
                        }
                        // echo "[ DEBUG ] RATINGS: ".$thisStarRating;
            

                        echo "<form action='../includes/dbh.comment.php' method='POST'>";

                        echo '<select name="stars">';
                        for ($i=1; $i <= 10; $i++) { 
                            echo '<option value="'.$i.'" '.(($thisStarRating==$i) ? "selected" : "").'>'.$i.'</option>';
                            // echo '<option value="'.$i.'" '.((isset($_POST["stars"]) && $_POST["stars"] == "$thisStarRating") ? "selected" : "").'>'.$i.'</option>';
                        }
                        echo '</select>';
            
                        echo "<input type='hidden' name='user_id' value='".$currentUserID."'/>";
                        echo "<input type='hidden' name='movie_id' value='".$currentMovieID."'/>";
                        echo "<input type='hidden' name='create' value='".$createComment."'/>";
                        echo "<input type='hidden' name='privilege' value='".$currentPrivilegeLevel."'/>";
                        if ($currentUserID == -1) {
                            echo "<input type='text' name='review' placeholder='Please log in to comment' class='textfield-comment' disabled/>";
                            echo "<input type='submit' class='button-submit' disabled/>";
                        } else {
                            echo "<input type='text' name='review' placeholder='Add your comment/review' value='".$currentComment."' class='textfield-comment'/>";
                            echo "<input type='submit' value='Publish Comment' class='button-submit'/>";
                        } 
                        echo "</form>";
                    ?>

                    <?php
                    if ($resultReview > 0) {
                        // $selectReviewUsername = "SELECT * FROM users, reviews WHERE users.users_id = reviews.users_id;";
                        $selectReviewUsername = "SELECT username FROM users, reviews,movies WHERE movies.Movies_ID = ".$currentMovieID." AND users.users_id = reviews.users_id AND movies.Movies_ID = reviews.Movies_ID;";
                        $queryReviewUsername = mysqli_query($conn, $selectReviewUsername);
                        while ($row = mysqli_fetch_assoc($queryReviewComment)) {
                            $user = mysqli_fetch_assoc($queryReviewUsername);
                            echo
                            '<div><p>'.
                            '<b>'.$user['username'].'</b><br>'. // username
                            $row['Review_Content']. // comment
                            '<br>(Rating: '.$row['Stars'].') '.' (Reviewed on: '.$row['Date_Of_Review'].')'; // rating + date
                            if ($currentPrivilegeLevel == 2 || $currentPrivilegeLevel == 3) {
                                echo "<form action='../includes/dbh.delete.php' method='POST'>";
                                echo "<input type='hidden' name='user_id' value='".$row['Users_ID']."'/>";
                                echo "<input type='hidden' name='movie_id' value='".$row['Movies_ID']."'/>";
                                echo "<input type='submit' value='Delete Comment Above' class='button-delete'>";
                                echo "</form>";
                            }
                            echo '</p></div>';
                        }
                    }
                    ?>
                </div>
            </div>

        <?php
            // echo "[ DEBUG ] MOVIE PROFILE <br>";
            // echo "[ DEBUG GET  ] ".json_encode($_GET);
            // echo "[ DEBUG POST ] ".json_encode($_POST);
        ?>

        <?php include 'footer.php' ?>
    </body>
</html>