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
    $userData['password'] = password_hash($userData['password'], PASSWORD_BCRYPT);
    $rows = prepareAndExecute("SELECT * FROM Customer WHERE customer_mail_address = :email", $userData)->fetchAll(PDO::FETCH_ASSOC);
    $userData['subscriptionStart'] = date("Y-m-d");
    if (count($rows) > 0) {
        return EMAIL_EXISTS;
    }
    switch (insertCustomer($userData)->errorCode()) {
        case "00000":
            return ALL_OK;
        break;
        default:
            return DATABASE_ERROR;
        break;
    }
}

function setUserSession($email)
{
    $userData = getUserData($email);
    if (is_null($userData['subscription_end'])) {
        $userData['subscription_end'] = false;
    }
    $_SESSION = array_merge($_SESSION, $userData);
    $_SESSION['loggedInSince'] = time();
}