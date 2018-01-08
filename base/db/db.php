<?php

require_once ("dbDefines.php");

/**
 * This function is supposed to connect to the database
 */

function getPdo() : PDO {
    global $pdo;
    if (is_a($pdo, "PDO")) {
        return $pdo;
    }
    $pdo = connect();
    return $pdo;
}

function connect() : PDO{

    try {
        $pdo = new PDO("sqlsrv:Server=".DB_HOST.";Database=".DB_DBNAME.";ConnectionPooling=0", DB_USER, DB_PASS);
    }
    catch (PDOException $e) {
        var_dump($e, $e->getMessage());
        die();
    }
    return $pdo;
}

