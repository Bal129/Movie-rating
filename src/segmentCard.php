<?php

// /**
//  * @brief read image blob
//  * @param $moviesID image reference
//  * @return image src from blob
//  */
function getImage($moviesID) {
    global $conn;
    $imageQuery = mysqli_query($conn, "SELECT Movie_Poster FROM movies WHERE movies.Movies_ID = $moviesID");
    while ($imageResult = mysqli_fetch_assoc($imageQuery)) {
        return '"data:image/jpeg;base64,'.base64_encode($imageResult["Movie_Poster"]).'"';
    }
}

// /**
//  * @brief display segment data card
//  * @param $movies sql query for movies data
//  */
function getData($movies) {
    global $conn;

    // INIT
    $moviesRating = 0;

    while ($movieRow = mysqli_fetch_assoc($movies)) {
        $moviesID = $movieRow['Movies_ID'];

        // Store all genre of current movies in this
        $genresArr = array();

        $moviesGenre = mysqli_query($conn, "SELECT * FROM movie_genres WHERE Movies_ID=$moviesID");
        while ($moviesGenreRow = mysqli_fetch_assoc($moviesGenre)) {
            $genresID = $moviesGenreRow['Genres_ID'];
            $genre = mysqli_query($conn, "SELECT * FROM genres WHERE Genres_ID=$genresID");

            while ($genreRow = mysqli_fetch_assoc($genre)) {
                $genresArr[] = $genreRow["Genres_Name"];
            }
        }

        $reviews = mysqli_query($conn, "SELECT AVG(reviews.Stars) as AvgStars FROM reviews WHERE $moviesID=reviews.Movies_ID GROUP BY Movies_ID");
        while ($reviewsRow = mysqli_fetch_assoc($reviews)) {
            $moviesRating = $reviewsRow["AvgStars"];
        }

        echo '<form action="movieProfile.php" method="GET" >';
        echo '<div class="segment_card">';
        echo '<div class="cover-container">';
        echo '<input type="image" src='.getImage($moviesID).' alt="Submit" class="movie-cover"/>';
        echo '</div>';
        echo '<div class="movie-details">';
        echo '<h2>'.$movieRow["Movies_Title"].'</h2>';
        echo '<input type="hidden" name="MOVIES_ID" value="'.$moviesID.'" readonly>';
        
        foreach ($genresArr as $genreEle) {
            echo '<p class="movie-genres">'.$genreEle.' </p>';
        }

        echo '<p class="movie-ratings">HISS Ratings: <b>'.number_format($moviesRating, 2).'</b></p>';
        echo '</div>';
        echo '</div>';
        echo '</form>';

        // foreach ($genresArr as $genreEle) {
        //     echo '<p class="movie-genres">'.$genreEle.'</p>';
        // }

        // echo '<p>HISS Ratings: <b>'.number_format($moviesRating, 2).'</b></p>';
    }
}

// /**
//  * @brief display default data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getDefaultData($limit, $offset) {
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY Movies_ID DESC LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));
    getData($movies);
}

// /**
//  * @brief display trending data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getTrendingData($limit, $offset) {
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY (SELECT AVG(reviews.Stars) FROM reviews WHERE movies.Movies_ID=reviews.Movies_ID GROUP BY Movies_ID) AND Date_Of_Release DESC LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));
    getData($movies);
}


// /**
//  * @brief display new release data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getNewReleaseData($limit, $offset) {
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY Date_Of_Release DESC LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));
    getData($movies);
}


// /**
//  * @brief display upcoming data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getUpcomingData($limit, $offset) {
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY Date_Of_Release LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));
    getData($movies);
}


// /**
//  * @brief display best of all time data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getBestOfAllTimeData($limit, $offset) {
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies ORDER BY (SELECT AVG(reviews.Stars) FROM reviews WHERE movies.Movies_ID=reviews.Movies_ID GROUP BY Movies_ID) DESC LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));
    getData($movies);
}


// /**
//  * @brief display searched data card
//  * @param $movieName movie name to query
//  */
function getSpecificData($movieName) {
    // SHOULD HAVE LIMIT N OFFSET TOO BUT WE'RE TOO LAZY FOR IT
    global $conn;
    $movies = mysqli_query($conn, "SELECT * FROM movies WHERE movies.movies_title LIKE '%$movieName%'");
    getData($movies);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// /**
//  * @brief display showtime data card
//  * @param $limit     number of card
//  * @param $offset    on which page
//  */
function getShowTime($limit, $offset) {
    global $conn;
    $uniqueMovies = mysqli_query($conn, "SELECT DISTINCT movies_id FROM premieres LIMIT ".$limit." OFFSET ".(($offset-1)*$limit));

    // foreach ($uniqueMovies as mysqli_fetch_assoc($movieID)) {
    while ($movieSpecific = mysqli_fetch_assoc($uniqueMovies)) {
        $movieID = $movieSpecific["movies_id"];

        $selectedMovie = mysqli_query($conn, "SELECT * FROM movies WHERE movies.movies_id = $movieID");

        while ($selectedMovieSpecific = mysqli_fetch_assoc($selectedMovie)) {
            echo "<div class='show-time-movies'>";
            echo "<div class='show-time-movie-cover'><a><img src=".getImage($movieID)." alt='Movie Cover'></a></div>";
            echo "<div class='show-time-movie-details'><h3>".$selectedMovieSpecific["Movies_Title"]."</h3>";
        }


        $uniqueCinemas = mysqli_query($conn, "SELECT DISTINCT cinemas_id FROM premieres WHERE premieres.movies_id = $movieID");
        while ($cinemaSpecific = mysqli_fetch_assoc($uniqueCinemas)) {
            $cinemaID = $cinemaSpecific["cinemas_id"];
            $premiersDetails = mysqli_query($conn, "SELECT * FROM premieres WHERE premieres.movies_id = $movieID AND premieres.cinemas_id=$cinemaID");
            $cinema = mysqli_query($conn, "SELECT * FROM cinemas WHERE cinemas.cinemas_id = $cinemaID");

            echo "<p>";
            while ($cinemaSpecific = mysqli_fetch_assoc($cinema)) {
                echo $cinemaSpecific["Cinemas_Name"]."<br>";
            }
            // echo $cinemaSpecific["Cinemas_Name"]."<br> | ";
            while ($premierSpecific = mysqli_fetch_assoc($premiersDetails)) {
                echo "<b>".$premierSpecific["Showtimes"]."</b><br>";
            }
            echo "</p>";
        }
        echo "<br></div></div>";
    }

}

?>