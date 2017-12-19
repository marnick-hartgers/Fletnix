<?php

$cssFiles = ["./style/shared.css",
    "./style/style_small.css",
    "./style/style_normal.css",
    "./style/profile.css",];

echo head($cssFiles);
echo  "
    <body>
        <input type='checkbox' id='header_toggle_button'>
        <header>
            <span class='profile'>Barry Boterham</span>
            <h1 class='header_title'>
                <label for='header_toggle_button' class='header_toggle_button_label'>
                    <img src='img/buttons/menu.png' alt='Menu'/>
                </label>
                <span>Abonnement</span>
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
        <main class='page-content'>

            <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->

                <p>Er zijn op het moment 3 verschillende abonnementen beschikbaar: MaxiNix, PreNix en PostNix</p>
                <div class='flex '>
                    <section class='subscription_block background-color1'>
                        <h2>MaxiNix</h2>
                        <p>Dit pakket bied de mogelijkheid om onbeperkt films te kijken tegen een enkele vaste prijs(&euro; 100,-).
                            Dit pakket is speciaal voor mensen die veel films kijken</p>
                    </section>
                    <section class='subscription_block background-color1'>
                        <h2>PreNix</h2>
                        <p>Dit is het prepaid pakket van NetNix. Voor het kijken van een film word er een credit verrekend.
Op elk moment is het mogelijk om credits te kopen(&euro; 1,- voor 10 credits)</p>
                    </section>
                    <section class='subscription_block background-color1'>
                        <h2>PostNix</h2>
                        <p>Dit is het postpaid pakket van NetNix. Elke film die wordt bekeken word aan het eind van de maand verrekend.
(&euro; 0,20 per film).
                            </p>
                    </section>
                </div>
            </div>
            <div class='content'> <!-- Validator zit te zeuren over missende h2-h6 bij article -->
                <form method='post' action='#'>
                    <table>
                        <tr>
                            <td><label for='firstName'>Voor- en achternaam</label></td>
                            <td><input type='text' id='firstName' tabindex='1'> <input type='text' id='lastName' tabindex='2'></td>
                            <td><label for='subscription'>Abonnement</label></td>
                            <td>
                                <select id='subscription' tabindex='6'>
                                    <option value='1'>MaxiNix</option>
                                    <option value='2'>PreNix</option>
                                    <option value='3'>PostNix</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for='birthDate'>Geboortedatum</label></td>
                            <td><input type='date' id='birthDate' tabindex='3'></td>
                            <td><label for='username'>Gebruikersnaam</label></td>
                            <td><input type='text' id='username' tabindex='7'></td>
                        </tr>
                        <tr>
                            <td><label for='country'>Land</label></td>
                            <td><input type='text' id='country' tabindex='4'></td>
                            <td><label for='password'>Wachtwoord</label></td>
                            <td><input type='password' id='password' tabindex='8'></td>
                        </tr>
                        <tr>
                            <td><label for='IBAN'>Rekeningnummer</label></td>
                            <td><input type='text' id='IBAN' tabindex='5' pattern='[A-Za-z]{2}[0-9]{2}[A-Za-z0-9]{0,30}'></td>
                            <td><label for='passwordCheck'>Wachtwoord</label></td>
                            <td><input type='password' id='passwordCheck' tabindex='9'></td>
                        </tr>
                        <tr>
                            <td colspan='2'></td>
                            <td colspan='2'><input type='submit' value='Registreren' tabindex='10'></td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </body>
</html>";