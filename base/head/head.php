<?php
function head($cssFiles = [])
{
    $head = '
<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Netnix</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="shortcut icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="/style/shared.css">        
        <link rel="stylesheet" media="screen and (max-width:1024px)" href="/style/style_small.css">
        <link rel="stylesheet" media="screen and (min-width:1024px)" href="/style/style_normal.css">
';
    foreach($cssFiles as $css){
        $head = $head . "<link rel='stylesheet' href='$css'>";
    }
    $head  = $head. '</head><body>';
    return $head;
}