<?php

function pageHeader(){
    $header = "
    <input type='checkbox' id='header_toggle_button'>
    <header>
        ".getHtmlUsername()."
        <div class=''>                
        </div>
        <h1 class='header_title'>
            <label for='header_toggle_button' class='header_toggle_button_label'>
                <img src='/img/buttons/menu.png' alt='Menu'/>
            </label>
            <span>NetNix</span>
        </h1>
        <nav class='header_index'>";

    $header = $header . pageNavigation();
    $header = $header . "</nav>
    </header>";

    return $header;
}

function getHtmlUsername() {
    if (isset($_SESSION['username'])) {
        return "<span class='profile'>{$_SESSION['username']}</span>";
    }
    return "<span class='profile'><a href='/login'>Log in</a></span>";
}