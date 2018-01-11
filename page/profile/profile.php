<?php

$cssFiles = ["/style/profile.css",];

echo
    head($cssFiles).
    pageHeader();

if (validateUserSession()) {
    include "registered.php";
}
else {
    include "unregistered.php";
}