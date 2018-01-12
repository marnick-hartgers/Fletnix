<?php

$migrateFunctions = [
    "convertCustomerPasswords",
];

function migrateCheck() {
    global $migrateFunctions;
    $queryResult = getPdo()->query(
        "SELECT CHARACTER_MAXIMUM_LENGTH as length 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_NAME = 'Customer' AND COLUMN_NAME = 'password'")->fetch(PDO::FETCH_ASSOC);
    if ($queryResult['length'] > 50) {
        return;
    }
    includeDir(ROOT."migrations");
    foreach ($migrateFunctions as $function) {
        $function();
    }
}
migrateCheck();
