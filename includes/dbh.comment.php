<?php
    // check for user id, if yes then have access to comment 
    // , if not redirect to login
    // insert comment to database and then update with timestamp, commment, and rating of user, userid, movieid
    session_start();
    require_once "dbh.connect.php";

    echo "[ DEBUG GET  ] ".json_encode($_GET);
    echo "[ DEBUG POST ] ".json_encode($_POST);

    if (isset($_SESSION["username"])) {
        // Do something if user is logged in
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['create'] == '1') {
                $insert = "INSERT INTO reviews (Movies_ID, Users_ID, Review_Content, Stars) VALUES ({$_POST['movie_id']}, {$_POST['user_id']},'{$_POST['review']}', '{$_POST['stars']}')";
                if (mysqli_query($conn, $insert)) {
                    echo "insert successfully";
                } else {
                    echo "Error inserting: " . mysqli_error($conn);
                }
            } else {
                $update = "UPDATE reviews SET Review_Content = '{$_POST['review']}' WHERE (reviews.Movies_ID = {$_POST['movie_id']} AND reviews.Users_ID = {$_POST['user_id']})";
                if (mysqli_query($conn, $update)) {
                    echo "insert successfully";
                } else {
                    echo "Error inserting: " . mysqli_error($conn);
                }
            }
        }
    }

    else {
        // Do something if user is not logged in
        header("location: ../src/login.php");
        exit();
    }

    
    echo "<br><br>";
    if (isset($_SESSION["username"])) {
        // // Do something if user is logged in
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // update stars movies n users id from post array
            $update = "UPDATE reviews SET Stars = ".$_POST['stars']." WHERE Movies_ID = ".$_POST['movie_id']." AND Users_ID = ".$_SESSION["Users_ID"];

            if (mysqli_query($conn, $update)) {
                echo "Update successfully";
            } else {
                echo "Error updating: " . mysqli_error($conn);
            }
        }
    }

    else {
        // Do something if user is not logged in
        header("location: ../src/login.php");
        exit();
    }

    header("location: ../src/movieProfile.php?MOVIES_ID=".$_POST["movie_id"]);

?>