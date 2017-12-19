<?php
$cssFiles = ["/style/watch.css",];

echo
    head($cssFiles).
    pageHeader();

echo  "

        <main class='page-content movie_container'>
            
            <video controls autoplay>
                <source src='content/mov1.mov' />
            </video>
        </main>
    </body>
</html>
";