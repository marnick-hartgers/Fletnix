<?php
$cssFiles = ["./style/shared.css",
    "./style/style_small.css",
    "./style/style_normal.css",
    "./style/watch.css",];

echo head($cssFiles);

echo "
    <body>
        <input type='checkbox' id='header_toggle_button'>
        <header>
        <span class='profile'>Barry Boterham</span>
            <h1 class='header_title'>
                <label for='header_toggle_button' class='header_toggle_button_label'>
                    <img src='img/buttons/menu.png' alt='Menu'/>
                </label>
                <span>Flexbox en posities</span>
            </h1>
            <nav class='header_index'>
                <ul>
                    <li>
                        <a href='index.html'>Home</a>
                    </li>    
                    <li>
                        <a href='browse.html?genre=all'>Browse</a>
                        <ul>
                            <li>
                                <a href='browse.html?genre=all'>Alles</a>
                            </li>    
                            <li>
                                <a href='browse.html?genre=Actie'>Actie</a>
                            </li> 
                            <li>
                                <a href='browse.html?genre=Horror'>Horror</a>
                            </li>                 
                            <li>
                                <a href='browse.html?genre=scifi'>Sci-fi</a>
                            </li> 
                            <li>
                                <a href='browse.html?genre=Familie'>Familie</a>
                            </li>  
                        </ul>
                    </li>    
                    <li>
                        <a href='about.html'>Over ons</a>
                        <ul>
                            <li>
                                <a href='about.html#marnick'>Marnick</a>
                            </li>
                            <li>
                                <a href='about.html#jelmer'>Jelmer</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href='profile.html'>Abonnement</a>
                    </li>            
                </ul>
            </nav>
        </header>
        <main class='page-content movie_container'>
            
            <video controls autoplay>
                <source src='content/mov1.mov' />
            </video>
        </main>
    </body>
</html>
";