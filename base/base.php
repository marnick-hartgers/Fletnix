<?php

/**
 * This function loads the correct page
 *
 * @return void
 */
function redirectToPage() {

    $unregisteredPages = ["about", "profile", "login"];
    $page = getUrlRoute(0);
    if (validateUserSession() == false && in_array($page, $unregisteredPages) === false) {
        // Disallow a non-authorized user from most pages
    }
    elseif ($page != "") {
        $pageDir = "page".DIRECTORY_SEPARATOR.$page;
        if (is_dir(ROOT.$pageDir)) {
            include_once ROOT.$pageDir.DIRECTORY_SEPARATOR.$page.".php";
            return;
        }
    }

    include_once ROOT."page".DIRECTORY_SEPARATOR."index".DIRECTORY_SEPARATOR."index.php";

}

/**
 * This function parses the url and returns an array with url `folders`, the specified index or null if the
 * specified index does not exist
 *
 * @param int|null $index
 * @return array|string|false
 */
function getUrlRoute(int $index = null)
{
    $url = preg_split("`/|\\\`", $_SERVER['REQUEST_URI']);
    array_shift($url);

    if (is_null($index) === false) {
        if (isset($url[$index])) {
            return $url[$index];
        }
        else {
            return false;
        }
    }
    return $url;
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function getCurrentWeekday() {
    return ["zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag"][date("w")];
}

function getCurrentMonth() {
    return ["januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"][date("n")-1];
}

/**
 * This function checks if the specified needles are present in the haystack
 * @param array $needles The needles to search for
 * @param array $haystack The haystack to search in
 *
 * @return bool true if all needles are present, false otherwise
 */
function allFieldsArePresent(array $needles, array $haystack) : bool {
    foreach ($needles as $needle) {
        if (isset($haystack[$needle]) === false) {

            return false;
        }
    }
    return true;
}