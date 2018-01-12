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
        return generateMovieStats($movieDetails,$cast);
    }    
}

function generateMovieStats($movieDetails,$cast){
    $title = $movieDetails["title"];
    $description = $movieDetails["description"];
    $imgSource = "/img/movies/" . $movieDetails["cover_image"];
    
    $imageStyle = 'url("'. $imgSource . '")';
    $playLink = "/watch/" . $movieDetails["movie_id"];
    $duration = $movieDetails["duration"] . "min";
    $year = $movieDetails["publication_year"];
    $movieCast = generateMovieCast($cast);
    return "
        <div class='movie_image'>
            <img src='$imgSource'>
            <a href='$playLink'><img src='/img/buttons/play.png'></a>
        </div>
        <article class='movie_desc'>
            <h1>$title</h1>
            <p>Year:$year</p>
            <p>Speeltijd: $duration</p>
            <p>$description</p>
            <h2>Cast</h2>
            $movieCast
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

echo
head($cssFiles).
pageHeader(true);

echo  "
    <main class='page-content'>    
    ".generateMovieDetails()."        
    </main>
</body>
</html>";