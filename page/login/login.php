<?php
if (validateUserSession()) {
    header("Location: /");
}
handleLoginPostParameters();
$cssFiles = ["/style/login.css"];
echo
    head($cssFiles).
    pageHeader().
    loginForm()
;

function loginForm():string{
    return "
    <body>
        <main class='page-content flex'>
            <div>
                <fieldset>
                    <form class='login_form' method='POST' action='/login'>
                        ".
                        makeInput("username", "Username", "text").
                        makeInput("password", "Password", "password").                      
                        "
                        <input type='submit' />
                    </form>
                </fieldset>
            </div>
        </main>
    </body>
    ";
}

function handleLoginPostParameters() {
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
        $userData = getUserData($usersEmail);
        if (is_null($userData['subscription_end'])) {
            $userData['subscription_end'] = false;
        }
        $_SESSION = array_merge($_SESSION, $userData);
        $_SESSION['loggedInSince'] = time();
    }
}