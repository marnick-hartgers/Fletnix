<?php
function pageheader(){
    return '
    <input type="checkbox" id="header_toggle_button">
    <header>
        <span class="profile">Barry Boterham</span>
        <div class="">                
        </div>
        <h1 class="header_title">
            <label for="header_toggle_button" class="header_toggle_button_label">
                <img src="img/buttons/menu.png" alt="Menu"/>
            </label>
            <span>NetNix</span>
        </h1>
        <nav class="header_index">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>    
                <li>
                    <a href="browse.html?genre=all">Browse</a>
                    <ul>
                        <li>
                            <a href="browse.html?genre=all">Alles</a>
                        </li>    
                        <li>
                            <a href="browse.html?genre=actie">Actie</a>
                        </li> 
                        <li>
                            <a href="browse.html?genre=horror">Horror</a>
                        </li>                 
                        <li>
                            <a href="browse.html?genre=scifi">Sci-fi</a>
                        </li> 
                        <li>
                            <a href="browse.html?genre=familie">Familie</a>
                        </li>  
                    </ul>
                </li>    
                <li>
                    <a href="about.html">Over ons</a>
                    <ul>
                        <li>
                            <a href="about.html#marnick">Marnick</a>
                        </li>
                        <li>
                            <a href="about.html#jelmer">Jelmer</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="profile.html">Abonnement</a>
                </li>            
            </ul>
        </nav>
    </header>';
}