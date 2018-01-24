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
        $cast =  getMovieCast($movieId);
        $directors = getMovieDirectors($movieId);
        return generateMovieStats($movieDetails,$cast, $directors);
    }    
}

function generateMovieStats($movieDetails,$cast, $directors){
    $title = $movieDetails["title"];
    $description = $movieDetails["description"];
    $imgSource = "/img/movies/" . $movieDetails["cover_image"];
    
    $imageStyle = 'url("'. $imgSource . '")';
    $playLink = "/watch/" . $movieDetails["movie_id"];
    $duration = $movieDetails["duration"] . "min";
    $year = $movieDetails["publication_year"];
    $price = $movieDetails["price"];
    $movieCast = generateMovieCast($cast);
    $directors = generateMovieDirectors($directors);
    return "
        <div class='movie_image'>
            <img src='$imgSource' alt='".htmlentities($title)." poster'>
            <a href='$playLink'><img src='/img/buttons/play.png' alt='".htmlentities($title)." afspelen'></a>
        </div>
        <article class='movie_desc'>
            <h2>$title</h2>
            <p>Year: $year</p>
            <p>Speeltijd: $duration</p>
            <p>Price: &euro;$price</p>
            <p>$description</p>
            <h3>Cast</h3>
            $movieCast
            <h3>Directors</h3>
            $directors
        </article>
    ";
}

function generateMovieCast($cast){
    $castStr = "<div class='movie_cast'>";
    foreach($cast as $person){
        //role, lastname, firstname, gender
        $name = $person["firstname"] . " " . $person["lastname"];
        $role = $person["role"];
        $castStr .= "
        <div>
            <h3>$name</h3>
            <p>$role</p>
        </div>
        ";
    }
    $castStr .= "</div>";
    return $castStr;
}
function generateMovieDirectors($dirs){
    $dirStr = "<div class='movie_cast'>";
    foreach($dirs as $person){
        //role, lastname, firstname, gender
        $name = $person["firstname"] . " " . $person["lastname"];
        $dirStr .= "
        <div>
            <h3>$name</h3>
        </div>
        ";
    }
    $dirStr .= "</div>";
    return $dirStr;
}

echo
head($cssFiles).
pageHeader(true);

echo  "
    <main class='page-content'>
    ".generateMovieDetails()."
    </main>";