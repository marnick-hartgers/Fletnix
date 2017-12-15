<?php

define("ROOT", dirname(__FILE__).DIRECTORY_SEPARATOR);
/**
 * This function includes every file in a directory and its subdirectories
 *
 * @param $dirToInclude string The directory that is to be included
 */
function includeDir($dirToInclude)
{
    foreach (scandir($dirToInclude) as $subDir) {
        if ($subDir == "." || $subDir == "..") {
            continue; // do not inlude those 'directories'
        }
        $subDir = $dirToInclude . DIRECTORY_SEPARATOR.$subDir;
        if (is_dir($subDir)) {
            includeDir($subDir);
        }
        if (is_file($subDir)) {
            include $subDir;
        }
    }
}
includeDir(ROOT . "base");

redirectToPage();