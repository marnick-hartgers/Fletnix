<?php
function addWatchRegister(array $movie, string $customerEmail ){
    $pdo = getPdo();

    $query = "INSERT INTO Watchhistory (movie_id ,customer_mail_address, watch_date, price, invoiced) VALUES (:movieid, :email, GETDATE(), :price, 0)";
    $param = [];
    $param[":movieid"] = $movie["movie_id"];
    $param[":email"] = $customerEmail;
    $param[":price"] = $movie["price"];
    $statement = $pdo->prepare($query);
    $statement->execute($param);
}
