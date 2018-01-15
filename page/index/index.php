<?php

$cssFiles = ["/style/index.css"];

echo
    head($cssFiles).
    pageHeader()
;

if(validateUserSession()){
    header("Location: /browse");
    die();
}

echo "
    <body>
        <main class='page-content'>            
            <article class='content welcomeWallpaper'>
                <div class='welcomeHeaderContainer'>
                    <h2 class='welcomeHeader'>Alles van IMDB binnen handbereik</h2>               
                    <h3>Onbeperkt film's kijken wanneer u wilt</h3>
                    <p>Ouder dan 18 en houd je van actiefilms? Profiteer dan nu en word nu ook lid. 
                    <a class='link_button' href='/profile'>Abboneer</a> vandaag nog</p>
                </div>                
            </article>
        </main>
    </body>
</html>";