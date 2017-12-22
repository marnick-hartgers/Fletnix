<?php

require_once ("dbDefines.php");

$pdo = connect();

/**
 * This function is supposed to connect to the database
 */
function connect() {
    try {
        $pdo = new PDO("sqlsrv:Server=".DB_HOST.";Database=Fletnix;ConnectionPooling=0", DB_USER, DB_PASS);
    }
    catch (PDOException $e) {
        var_dump($e, $e->getMessage());
        die();
    }
    return $pdo;
}

