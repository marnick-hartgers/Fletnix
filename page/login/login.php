<?php

$validationMessage = "";
handleLoginPostParameters();
if (validateUserSession()) {
    header("Location: /");
    die();
}
$cssFiles = ["/style/login.css"];
echo
    head($cssFiles).
    pageHeader().
    loginForm()
;



function loginForm():string{
    global $validationMessage;
    return "
    <body>
        <main class='page-content flex'>
            <div>
                <fieldset>
                    <form class='login_form' method='POST' action='/login'>
                        <h1>Login</h1>
                        <p class='loginerror'>$validationMessage</p>
                        ".
                        makeInput("username", "Username", "text").
                        makeInput("password", "Password", "password").                      
                        "
                        <input type='submit' value='Login'/>
                    </form>
                </fieldset>
            </div>
        </main>
    </body>
    ";
}

function handleLoginPostParameters() {
    global $validationMessage;
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
        return;
    }
    $username = $_POST["username"];
    $password = $_POST["password"];

    /*
     * If the password field in Customer would be longer there would be the possibility to use some encrypting of the password
     * As it is, this is not possible using a 'safe' encryption method
     */
    $usersEmail = validateUser($username, $password);
    if($usersEmail != false) {
        setUserSession($usersEmail);
    }else{
        $validationMessage = "Gebruikersnaam of wachtwoord incorrect";
    }
}