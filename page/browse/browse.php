<?php


$cssFiles = ["./style/browse.css",];

echo
    head($cssFiles).
    pageHeader();

echo  "

        <main class='page-content flex'>
            <article class='content movie'>
                <a href='terminator.html'>
                    <h2>Terminator</h2>

                    <p>A seemingly indestructible humanoid cyborg is sent from 2029 to 1984 to assassinate a waitress,
                        whose unborn son will lead humanity in a war against the machines,
                        while a soldier from that war is sent to protect her at all costs.</p>
                    <img src='img/movies/Terminator.jpg' alt='Terminator poster'>
                </a>
            </article>

            <article class='content movie'>
                <a href='watch.html'>
                    <h2>Terminator 2</h2>

                    <p>A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her ten year old
                        son, John Connor, from a more advanced cyborg. </p>
                    <img src='img/movies/Terminator2.jpg' alt='Terminator 2 poster'>
                </a>
            </article>

            <article class='content movie'>
                <a href='#'>
                    <h2>Terminator 3</h2>

                    <p>A cybernetic warrior from a post-apocalyptic future travels back in time to protect a 25-year old
                        drifter and his future wife from a most advanced robotic assassin and to ensure they both
                        survive a nuclear attack. </p>
                    <img src='img/movies/Terminator3.jpg' alt='Terminator 3 poster'>
                </a>
            </article>

            <article class='content movie'>
                <a href='#'>
                    <h2>The Dark Knight</h2>
                    <p>When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on
                        the people of Gotham, the Dark Knight must accept one of the greatest psychological and physical
                        tests of his ability to fight injustice. </p>
                    <img src='img/movies/TheDarkKnight.jpg' alt='The Dark Knight poster'>
                </a>
            </article>

            <article class='content movie'>
                <a href='#'>
                    <h2>The Matrix</h2>
                    <p>A computer hacker learns from mysterious rebels about the true nature of his reality and his role
                        in the war against its controllers. </p>
                    <img src='img/movies/TheMatrix.jpg' alt='The Matrix poster'>
                </a>
            </article>

            <article class='content movie'>
                <a href='#'>
                    <h2>Seven Samurai</h2>
                    <p>A poor village under attack by bandits recruits seven unemployed samurai to help them defend
                        themselves. </p>
                    <img src='img/movies/SevenSamurai.jpg' alt='Seven Samurai poster'>
                </a>
            </article>
            <article class='content movie'>
                <a href='#'>
                    <h2>Dangal</h2>
                    <p>Former wrestler Mahavir Singh Phogat and his two wrestler daughters struggle towards glory at the
                        Commonwealth Games in the face of societal oppression. </p>
                    <img src='img/movies/Dangal.jpg' alt='Dangal poster'>
                </a>
            </article>


        </main>
    </body>
</html>";