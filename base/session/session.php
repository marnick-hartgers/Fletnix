<?php

function validateUserSession() : bool{
    $requiredFields = [
        "mailAddress",
        "username",
        "contract_type",
        "subscription_end",
        "country_name",
        "birth_date",
        "gender",
        "loggedInSince"
    ];

    if (allFieldsArePresent($requiredFields, $_SESSION) === false) {
        $_SESSION = [];
        return false;
    }
    return true;
}

function registerUser(array $userData) : int {
    $userData['password'] = password_hash($userData['password']);
    $rows = prepareAndExecute("SELECT * FROM Customer WHERE customer_mail_address = :email", $userData)->fetchAll(PDO::FETCH_ASSOC);
    $userData['subscriptionStart'] = date("Y-m-d");
    if (count($rows) > 0) {
        return EMAIL_EXISTS;
    }
    $query = "
        INSERT INTO Customer
            (customer_mail_address, lastname, firstname, payment_method, payment_card_number, contract_type, subscription_start, 
                user_name, password, country_name, gender, birth_date )
        VALUES (
            :email,
            :lastName,
            :firstName,
            :payment_method,
            :cardNumber,
            :contract,
            :subscriptionStart,
            :username,
            :password,
            :country,
            :gender,
            :birthDate
        )";
    switch (prepareAndExecute($query, $userData)->errorCode()) {
        case "00000":
            return ALL_OK;
        break;
        default:
            return DATABASE_ERROR;
        break;
    }
}