<?php

function migrateCheck() {
    includeDir(ROOT."migrations");

    $migrateFunctions = [
        "convertCustomerPasswords"
    ];

    foreach ($migrateFunctions as $mfunction) {
        $mfunction();
    }
}
migrateCheck();

/**
 * This function gets column information of the specified table
 *
 * @param string $table The table to fetch the info of
 *
 * @return array An array where the column name is the key and the properties are the values
 */
function getColumnInfo(string $table) : array{
    $queryResult = prepareAndExecute(
        "SELECT 
            COLUMN_NAME as colname, 
            CHARACTER_MAXIMUM_LENGTH as length, 
            DATA_TYPE AS type, 
            IS_NULLABLE AS canbenull 
        FROM
            INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_NAME = :table", ['table' => $table])->fetchAll(PDO::FETCH_ASSOC);
    $columns = [];
    foreach ($queryResult as $value) {
        $colname = $value['colname'];
        unset($value['colname']);
        $columns[$colname] = $value;
    }
    return $columns;

}