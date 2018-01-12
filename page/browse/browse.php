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
                <img src='$imgSource' alt='{$movieData['title']} poster'>
            </a>
        </article>";
}

function buildMovieArticles() {
    if (getUrlRoute(1) == "search") {
        $movies = searchMovie($_POST['keyword']);
    }
    elseif (getUrlRoute(1) != false) {
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
        <form action='/browse/search' method='post'>
            <input type='text' name='keyword' placeholder='Zoek een film...'><input type='submit' value='Zoek'>
        </form>";
}

echo
    head($cssFiles).
    pageHeader();

echo  "
        <main class='page-content flex'>
                
        
        ".searchForm().buildMovieArticles()."
            
        </main>
    </body>
</html>";