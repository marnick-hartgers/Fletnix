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

    foreach ($requiredFields as $key => $value) {
        if (isset($_SESSION[$value]) === false) {
            $_SESSION = [];
            return false;
        }
    }
    return true;
}