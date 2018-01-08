<?php
handlePostParameters();
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

function handlePostParameters(){
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
        return;
    }
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username != "" && $password == "geheim"){
        $_SESSION["username"] = $username;
    }
}