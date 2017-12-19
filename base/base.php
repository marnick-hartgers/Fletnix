<?php

/**
 * This function loads the correct page
 *
 * @return void
 */
function redirectToPage() : void {

    $page = getUrlRoute(0);
    if ($page != "") {
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