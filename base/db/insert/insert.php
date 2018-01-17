<?php
function addWatchRegister(array $movie, string $customerEmail ){
    $query = "
    INSERT INTO Watchhistory (
        movie_id, 
        customer_mail_address, 
        watch_date, 
        price, 
        invoiced
    ) 
    VALUES (
        :movieid, 
        :email, 
        GETDATE(), 
        :price, 
        0
    )";
    $param = [
        "movieid" => $movie["movie_id"],
        "email" => $customerEmail,
        "price" => $movie["price"],];
    prepareAndExecute($query, $param);
}

function insertCustomer($customerData)
{

    $query = "
    INSERT INTO Customer
        (customer_mail_address, lastname, firstname, payment_method, payment_card_number, contract_type, subscription_start,
        user_name, password, country_name, gender, birth_date )
    VALUES (
        :email,
        :lastName,
        :firstName,
        :payment_method,
        :cardnumber,
        :contract,
        :subscriptionStart,
        :username,
        :password,
        :country,
        :gender,
        :birthDate
    )";

    return prepareAndExecute($query, $customerData);
}