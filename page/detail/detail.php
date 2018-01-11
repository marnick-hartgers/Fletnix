<?php
$cssFiles = ["/style/detail.css",];

function generateMovieDetails(){

    $movieIdString = getUrlRoute(1);
    if($movieIdString == "saai"){
        return genRandomData(); 
    }else{
        if(is_nan($movieIdString)){
            return "";
        }
        $movieId = (int)$movieIdString;
        $movieDetails = getMovieDetails($movieId);
        return generateMovieStats($movieDetails);
    }    
}

function generateMovieStats($movieDetails){
    $title = $movieDetails["title"];
    $description = $movieDetails["description"];
    $imgSource = "/img/movies/" . $movieDetails["cover_image"];
    
    $imageStyle = 'url("'. $imgSource . '")';
    $playLink = "/watch/" . $movieDetails["movie_id"];
    $duration = $movieDetails["duration"] . "min";
    return "
        <div class='movie_image'>
            <img src='$imgSource'>
            <a href='$playLink'><img src='/img/buttons/play.png'></a>
        </div>
        <article class='movie_desc'>
            <h1>$title</h1>
            <p>Speeltijd: $duration</p>
            <p>$description</p>
        </article>
    ";
}

echo
head($cssFiles).
pageHeader(true);

echo  "
    <main class='page-content'>    
    ".generateMovieDetails()."        
    </main>
</body>
</html>";