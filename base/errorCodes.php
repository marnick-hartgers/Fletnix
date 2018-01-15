<?php
$errorCodes = [
    "all_ok" => 0,
    "email_exists" => 1,
    "missing_fields" => 2,
    "passwords_no_match" => 3,
    "database_error" => 4,
];

foreach ($errorCodes as $name => $code) {
    define(strtoupper($name), $code);
}
