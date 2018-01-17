<?php

function getGenres(): array
{
    $pdo = getPdo();
    return $pdo->query("SELECT genre_name FROM Genre;")->fetchAll(PDO::FETCH_COLUMN, "genre_name");
}

function getMovies(string $genre = "", int $page = 1): array
{
    $query = "
        SELECT Movie.movie_id, 
            title,
            Movie.description as description, 
            cover_image, 
            ROW_NUMBER() OVER(ORDER BY Movie.publication_year DESC) AS Row#,
            (SELECT count(*) FROM Watchhistory INNER JOIN Movie m ON m.movie_id = Watchhistory.movie_id) AS times_watched 
        FROM Movie";
    $param = [
        "genre" => $genre,
        "lowerLimit" => (int)(($page - 1) * 51) + 1,
        "upperLimit" => (int)(($page - 1) * 51) + 51,
    ];
    if ($genre != "") {
        $query .= " INNER JOIN Movie_Genre ON Movie.movie_id = Movie_Genre.movie_id
                    INNER JOIN Genre on Movie_Genre.genre_name = Genre.genre_name 
                    WHERE Genre.genre_name = :genre "; // Space is important here
    }

    $query = "WITH movies AS ({$query}) SELECT * FROM movies WHERE Row# BETWEEN :lowerLimit and :upperLimit ORDER BY times_watched DESC";
//    ob_clean();var_dump($query);var_dump(prepareAndExecute($query, $param)->fetchAll(PDO::FETCH_ASSOC));die;
    return prepareAndExecute($query, $param)->fetchAll(PDO::FETCH_ASSOC);
}

function getMovieCount(string $genre = "")
{
    $query = "SELECT COUNT(*) AS movies FROM Movie";
    if ($genre != "") {
        $query .= " INNER JOIN Movie_Genre ON Movie.movie_id = Movie_Genre.movie_id
                    INNER JOIN Genre on Movie_Genre.genre_name = Genre.genre_name 
                    WHERE Genre.genre_name = :genre "; // Space is important here
    }

    return prepareAndExecute($query, ["genre" => $genre])->fetch(PDO::FETCH_COLUMN, "movies")[0];
}

function getMovieDetails(int $movieId)
{
    $pdo = getPdo();

    $query = "SELECT * FROM Movie WHERE Movie.movie_id = :movieId";
    $param = [];
    $param[":movieId"] = $movieId;
    $statement = $pdo->prepare($query);
    $statement->execute($param);

    return $statement->fetch(PDO::FETCH_ASSOC);
}
function getMovieCast(int $movieId){
    $query = "
        SELECT 
            role, 
            lastname, 
            firstname, 
            gender 
        FROM Movie_Cast, Person 
        WHERE Movie_Cast.movie_id = :movieId AND Movie_Cast.person_id = Person.person_id";

    return prepareAndExecute($query, ["movieId"=>$movieId])->fetchAll(PDO::FETCH_ASSOC);
}

function validateUser(string $username, string $password)
{
    $query = "
        SELECT password, customer_mail_address as email
        FROM Customer 
        WHERE user_name = :username
    ";

    $results = prepareAndExecute($query, ["username" => $username,])->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $result) {
        if (password_verify($password, $result['password'])) {
            return $result['email'];
        }
    }
    return false;
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
 * @param string $userEmail The users email address to retrieve the data of
 * @return array
 */
function getUserData(string $userEmail = ""): array
{
    $query = "
        SELECT customer_mail_address as mailAddress, user_name as username, contract_type, subscription_end, country_name, birth_date, gender
        FROM Customer
        WHERE customer_mail_address = :userEmail
    ";
    $statement = prepareAndExecute($query, ["userEmail" => $userEmail]);

    return $statement->errorCode() == "00000" ? $statement->fetch(PDO::FETCH_ASSOC) : [];

}

function getCountries(): array
{
    $query = "SELECT country_name FROM Country";
    $results = prepareAndExecute($query)->fetchAll(PDO::FETCH_COLUMN, "country_name");

    return count($results) > 0 ? $results : [];
}

function getPaymentMethods(): array
{
    $query = "SELECT payment_method FROM Payment";
    $results = prepareAndExecute($query)->fetchAll(PDO::FETCH_COLUMN, "payment_method");

    return count($results) > 0 ? $results : [];
}

function getContracts(): array
{
    $query = "SELECT contract_type as contract, price_per_month as price FROM Contract";
    $results = prepareAndExecute($query)->fetchAll(PDO::FETCH_ASSOC);

    return count($results) > 0 ? $results : [];

}

function searchMovie($searchWord, $page = 1): array
{
    $query = "
        SELECT 
            Movie.movie_id, 
            title, 
            Movie.description as description, 
            cover_image, 
            ROW_NUMBER() OVER(ORDER BY Movie.publication_year DESC) AS Row#,
            (SELECT COUNT(*) FROM Watchhistory INNER JOIN Movie m ON m.movie_id = Watchhistory.movie_id) AS times_watched            
        FROM Movie";
    $query = "WITH movies AS ({$query}) SELECT * FROM movies WHERE title LIKE :search ORDER BY times_watched DESC";
    $param = [
        "search" => "%" . $searchWord . "%",
        "lowerLimit" => (int)(($page - 1) * 51) + 1,
        "upperLimit" => (int)(($page - 1) * 51) + 51,
    ];
    return prepareAndExecute($query, $param)->fetchAll(PDO::FETCH_ASSOC);
}