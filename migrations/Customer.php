<?php

function convertCustomerPasswords() {
    $pdo = getPdo();
    $pdo->query("ALTER TABLE Customer ALTER COLUMN password VARCHAR(60)");
    $users = $pdo->query("SELECT customer_mail_address as mail, password FROM Customer")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $key => $value) {
        convertCustomerPassword($value['password'], $value['mail']);
    }
}

function convertCustomerPassword($password, $user) {
    $passwordInfo = password_get_info($password);
    if ($passwordInfo['algoName'] != "unknown") {
        return;
    }
    $hashed = password_hash($password, PASSWORD_BCRYPT);
    prepareAndExecute(
        "UPDATE Customer SET password = :password WHERE customer_mail_address = :user",
        ["user" => $user, "password"=>$hashed]
    );
}