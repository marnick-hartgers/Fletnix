<?php

function pageHeader(){
    $header = "
    <input type='checkbox' id='header_toggle_button'>
    <header>        
        <div class='user'>  
        ".getHtmlUsername()."              
        </div>
        <h1 class='header_title'>
            <label for='header_toggle_button' class='header_toggle_button_label'>
                <img src='/img/buttons/menu.png' alt='Menu'/>
            </label>
            <a href='/'>NetNix</a>
        </h1>
        <nav class='header_index'>";

    $header = $header . pageNavigation();
    $header = $header . "</nav>
    </header>";

    return $header;
}


function getHtmlUsername() {
    if (isset($_SESSION['username'])) {
        return "
        ".getCurrentWeekday().date(" d ").getCurrentMonth().date(" Y")."<br />
        <a href='/profile'>{$_SESSION['username']}</a> logged in since ".date("Y-m-d H:i")."
        <br />
        <a href='/logout'>Logout</a>
        ";
    }
    return "<span class='profile'><a href='/login'>Log in</a></span>";
}