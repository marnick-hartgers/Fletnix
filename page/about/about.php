<?php

$cssFiles = ["/style/about.css",];
echo
    head($cssFiles).
    pageHeader();

echo  "

        <main class='page-content about flex' >
            <div class='content_flexbox' >
                <article id = 'marnick' class='flexbox_content' >
                    <h2 > Marnick</h2 >
                    <p > Mijn naam is Marnick . Ik ben één van de ontwikkelaars van deze site . In mijn vrije tijd maak ik ook software maar dan voor me eigen projecten .
Ook maak ik foto's in me vrije tijd. Deze zijn online ook terug te vinden onder de naam &quot;photos_by_marnick&quot;
                        <br />
                        <br />
                        Samen met Jelmer hebben we deze site gebouwd voor een opdracht van school. Het is een best leuke opdracht ik vind het een goed begin om HTML te leren aan beginnende studenten. 
                    </p>
                </article>
                <article id='jelmer' class='flexbox_content'>
                    <h2>Jelmer</h2>
                    <div>
                        <img src='/img/about/jelmer.jpg' alt='Afbeelding van Jelmer'>
                        <p>
                            Mijn naam is Jelmer. Ik ben een Applicatieontwikkelende dierhouder volgens mijn diploma's . Niet dat ik
                            veel meer met dieren wil doen dan enkel als huisdier houden . Als ik voorbeelddata moet makken doe ik
                            dat veel liever door de lorem ipsum generator te gebruiken die in PhpStorm ingebouwd zit . Die geeft
                            namelijk genoeg tekst om iets mee te kunnen, zoals in de volgende alinia wel te zien is
</p >
                        <p ><s >
Lorem ipsum dolor sit amet, consectetur adipisicing elit . Animi, cupiditate deserunt dicta, dolorem
                            eligendi enim error impedit obcaecati, odit optio quasi voluptate ? In, nemo, ut . Hic incidunt sequi
                            sit voluptate ?</s >
                        </p >
                        <p > Oeps . Dat is ook zo, volgens de opdracht mocht je er geen lorem ispum in gebruiken...</p >
                    </div >
                </article >
            </div >
        </main >
    </body >
</html >";