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

function validateUser(string $username, string $password) {
    $pdo = getPdo();

    $query = "
        SELECT COUNT(*) 
        FROM Customer 
        WHERE user_name = :username AND password = :password
    ";
    $param = [
        ":username" => $username,
        ":password" => $password
    ];

    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->fetch()[0] == 1;
}

/**
 * This function returns the following fields of the specified user:
 *  - user_name as username
 *  - contract_type
 *  - subscription_end
 *  - country_name
 *  - birth_date
 *  - gender
 *
 * @param string $username The username to retrieve the data of
 * @return array
 */
function getUserData(string $username = "") : array {
    $pdo = getPdo();

    $query = "
        SELECT customer_mail_address as mailAddress, user_name as username, contract_type, subscription_end, country_name, birth_date, gender
        FROM Customer
        WHERE user_name = :username
    ";
    $param = [":username" => $username];
    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->errorCode() == "00000" ? $statement->fetch(PDO::FETCH_ASSOC) : [];

}

function searchMovie($searchWord) : array {

}