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
        $pdo = new PDO("sqlsrv:Server=".DB_HOST.";Database=". DB_DBNAME .";ConnectionPooling=0", DB_USER, DB_PASS);
    }
    catch (PDOException $e) {
        var_dump($e, $e->getMessage());
        die();
    }
    return $pdo;
}

/**
 * Prepare a query and execute it
 *
 * @param string $query The query to run
 * @param array $parameters An array containing at least the required parameters
 * @return PDOStatement
 */
function prepareAndExecute(string $query, array $parameters = []) : PDOStatement{
    try {
        $parameters = parametrize($query, $parameters);
        $statement = getPdo()->prepare($query);

        if (is_a($statement, "PDOStatement") === false) {
            throw new PDOException(getPdo()->errorInfo()[2], getPdo()->errorInfo()[1]);
        }
        elseif ($statement->execute($parameters) == false) {
            throw new PDOException($statement->errorInfo()[2], $statement->errorInfo()[1]);
        } else {
            return $statement;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br />Stopping exectution at db.php:34";
        die;
    }
}


/**
 * Pick the required parameters from an array and prepare the an array of parameters
 *
 * @param string $query The query
 * @param array $parameters An array containing at least the required parameters
 * @return array An array containing only the required parameters, ready to be used with the query
 *
 * @throws PDOException
 */
function parametrize(string $query, array $parameters) : array
{
    if (count($parameters) > 0 && preg_match_all("`:([a-zA-Z0-9_]{1,})`", $query, $matches) !== false) {
        $outputParameters = [];
        foreach ($matches[1] as $key => $parameter) {
            if (isset($parameters[$matches[0][$key]]) === true) {
                $outputParameters[":{$parameter}"] = $parameters[":{$parameter}"];
                continue;
            } elseif (isset($parameters[$parameter]) === true) {
                $outputParameters[':' . $parameter] = $parameters[$parameter];
            } else {
                $e = new PDOException(
                    "Invalid parameter number: number of bound variables does not match number of tokens. Missing parameter '{$parameter}'",
                    "HY093");
                $this->handleException($e, $query, $parameters);
            }
        }
        $parameters = $outputParameters;
    }
    return $parameters;
}