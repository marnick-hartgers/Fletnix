<?php
$cssFiles = ["/style/watch.css",];

function generateMovieDetails(){
    $movieId = (int)getUrlRoute(1);
    $movieDetails = getMovieDetails($movieId);
    return buildVideoFrame($movieDetails);
}

function buildVideoFrame($movieDetails){
    $url = "https://www.youtube.com/embed/" . $movieDetails["URL"] . "?autoplay=1";
    return "
        <iframe src='$url' />
    ";
}


echo
head($cssFiles).
pageHeader();

echo  "
    <main class='flex'>
        <div class='movie_container'>
            ".generateMovieDetails()."
        </div>
    </main>
</body>
</html>";