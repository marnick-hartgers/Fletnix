<?php

$cssFiles = ["/style/browse.css",];

function buildMovie($movieData) : string {
    $url = "/movie/detail/".str_ireplace(" ","_",$movieData['title']);
    if (isset($movieData['poster']) == false) {
        $movieData['poster'] = "";
    }
    return
        "<article class='content movie'>
            <a href='{$url}'>
                <h2>".ucfirst($movieData['title'])."</h2>
                <p>{$movieData['description']}</p>
                <img src='{$movieData['poster']}' alt='{$movieData['title']} poster'>
            </a>
        </article>";
}

function buildMovieArticles() {
    if (getUrlRoute(1) != false) {
        $movies = getMovies(getUrlRoute(1));
    }
    else {
        $movies = getMovies();
    }
    $mainArticle = "";
    foreach ($movies as $movie) {

        $mainArticle.= buildMovie($movie);
    }
    return $mainArticle;

}

echo
    head($cssFiles).
    pageHeader();

echo  "
        <main class='page-content flex'>
        
        ".buildMovieArticles()."
            
        </main>
    </body>
</html>";