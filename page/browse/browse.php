<?php

$cssFiles = ["/style/browse.css",];

function buildMovie($movieData) : string {
    $url = "/detail/".$movieData['movie_id'];
    if (isset($movieData['poster']) == false) {
        $movieData['poster'] = "";
    }
    $imgSource = "/img/movies/" . $movieData['cover_image'];
    return
        "<article class='content movie'>
            <a href='{$url}'>
                <h2>".ucfirst($movieData['title'])."</h2>
                <p>{$movieData['description']}</p>
                <img src='$imgSource' alt='".htmlentities($movieData['title'])." poster'>
            </a>
        </article>";
}

function buildMovieArticles() {
    $urlRoute = getUrlRoute(1);
    if ($urlRoute && str_split($urlRoute, 6)[0] == 'search' && isset($_GET['keyword'])) {
        $movies = searchMovie($_GET['keyword'] . "");
    }
    elseif ($urlRoute != false) {
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

function searchForm() {
    return "
        <form action='/browse/search' method='get'>
            ".makeInputWithSubmit("keyword", "Zoek een filmtitel...", "Zoek")."
            
        </form>";
}

echo
    head($cssFiles).
    pageHeader();

echo  "
        <main class='page-content flex'>
        <div>
            ".searchForm()."
        </div>
        <div class='flex flex_space_around'>
            ". buildMovieArticles()."   
        </div>         
        </main>
    </body>
</html>";