<?php


function genRandomData(){
    $pdo = getPdo();
    $movies = $pdo->query("SELECT TOP (10000) movie_id FROM Movie ORDER BY Movie.publication_year DESC;")->fetchAll(PDO::FETCH_COLUMN, "movie_id");

    $movieVideos = ["dP9Wp6QVbsk", "dQw4w9WgXcQ", "tVj0ZTS4WF4", "oavMtUWDBTM", "vio9rVMMfkA", "f5HX67WqUSY", "HpVhSx0fZwM", "8C1z7OlhJJ4", "dSeJ73JpUxU"];
    $covers = ["Terminator.jpg", "Dangal.jpg", "SevenSamurai.jpg", "Terminator2.jpg", "Terminator3.jpg", "TheDarkKnight.jpg", "TheMatrix.jpg"];
    $bigAssQueryString = "";
    foreach($movies as $movieId){
        //echo "Randomizing $movieId<br>";
        $movieVideo = $movieVideos[rand(0,count($movieVideos) - 1)];
        $cover = $covers[rand(0,count($covers) - 1)];
        $bigAssQueryString .= "update Movie SET URL = '$movieVideo', cover_image='$cover' WHERE movie_id = $movieId;";
    }
    echo "query";
    $pdo->query($bigAssQueryString);
    echo "done";
}