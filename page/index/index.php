<?php

$cssFiles = ["/style/index.css"];

echo
    head($cssFiles).
    pageHeader()
;

echo "
    <body>
        <main class='page-content'>
            
            <article class='content welcomeWallpaper'>
                <div class='welcomeHeaderContainer'>
                    <h2 class='welcomeHeader'>Alles van IMDB binnen handbereik</h2>               
                    <h3>Onbeperkt film's kijken wanneer u wilt</h3>
                    <p>Ouder dan 18 en houd je van actiefilms? Profiteer dan nu en word nu ook lid. <a class='link_button' href='profile.html'>Abboneer</a> vandaag nog</p>
                </div>                
            </article>
            
            <!--<div class='content_flexbox'>
                <article class='flexbox_content'>
                    <h1>Flexbox content</h1>
                </article>
            </div>
            -->
        </main>
    </body>
</html>";