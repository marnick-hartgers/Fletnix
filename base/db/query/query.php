<?php

function getGenres() : array {
    $pdo = getPdo();
    return $pdo->query("SELECT genre_name FROM Genre;")->fetchAll(PDO::FETCH_COLUMN, "genre_name");
}

function getMovies(string $genre = "", int $page = 1) : array {
    $pdo = getPdo();

    $query = "SELECT Movie.movie_id, title, Movie.description as description, cover_image, ROW_NUMBER() OVER(ORDER BY Movie.movie_id ASC) AS Row# FROM Movie";
    $param = [];
    if ($genre != "") {
        $query.= " INNER JOIN Movie_Genre ON Movie.movie_id = Movie_Genre.movie_id
                    INNER JOIN Genre on Movie_Genre.genre_name = Genre.genre_name 
                    WHERE Genre.genre_name = :genre
                    ";
        $param[":genre"] = $genre;
    }

    $query = "WITH movies AS ({$query}) SELECT * FROM movies WHERE Row# BETWEEN :lowerLimit and :upperLimit";
    
    $param[":lowerLimit"] = (int) (($page-1) * 51) + 1;
    $param[":upperLimit"] = (int) (($page-1) * 51) + 51;

    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getMovieCount(string $genre = "") {
    $pdo = getPdo();

    $query = "SELECT COUNT(*) AS movies FROM Movie";
    $param = [];
    if ($genre != "") {
        $query.= " INNER JOIN Movie_Genre ON Movie.movie_id = Movie_Genre.movie_id
                    INNER JOIN Genre on Movie_Genre.genre_name = Genre.genre_name 
                    WHERE Genre.genre_name = :genre
                    ";
        $param[":genre"] = $genre;
    }
    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->fetch(PDO::FETCH_COLUMN, "movies")[0];
}
function getMovieDetails(int $movieId){
    $pdo = getPdo();

    $query = "SELECT * FROM Movie WHERE Movie.movie_id = :movieId";
    $param = [];
    $param[":movieId"] = $movieId;
    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->fetch(PDO::FETCH_ASSOC);
}