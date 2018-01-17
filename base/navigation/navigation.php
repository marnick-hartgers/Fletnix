<?php

/**
 * This function prepares the genres from the database for use in the menu
 *
 * @return array
 */
function getMovieNavigation(): array
{

    // get the genres from the database
    $genres = getGenres();

    $return = [
        [
            "title" => "Alles",
            "href" => "/browse",
            "subitems" => [],
            "requireLogin"=>true
        ],
    ];
    foreach ($genres as $genre) {
        $return[] = [
            "title" => $genre,
            "href" => "/browse/" . $genre,
            "subitems" => [],
            "requireLogin"=>true
        ];
    }

    return $return;

}

function getNavigationTree(): array
{
    $navigationItems = [
        [
            "title" => "Home",
            "href" => "/",
            "subitems" => [],
            "requireLogin" => false
        ],
        [
            "title" => "Browse",
            "href" => "/browse",
            "subitems" => getMovieNavigation(),
            "requireLogin" => true
        ],
        [
            "title" => "Over ons",
            "href" => "/about",
            "subitems" => [],
            "requireLogin"=>false
        ],
        [
            "title" => "Abonnement",
            "href" => "/profile",
            "subitems" => [],
            "requireLogin"=>false
        ]
    ];
    return $navigationItems;
}


function pageNavigation(): string
{
    $navigationItems = getNavigationTree();
    $navString = "<ul>";
    foreach ($navigationItems as $item) {
        $navString = $navString . buildNavigationItem($item);
    }
    $navString = $navString . "</ul>";
    return $navString;
}

function buildNavigationItem(array $navItem): string
{
    if($navItem["requireLogin"] == true && !validateUserSession()){
        return "";
    }
    $title = $navItem["title"];
    $href = $navItem["href"];
    $itemString = "
    <li>
        <a href='$href' >$title</a>
        <ul>";
    foreach ($navItem["subitems"] as $subitem) {
        $itemString = $itemString . buildNavigationItem($subitem);
    }

    $itemString = $itemString . "</ul></li>";
    return $itemString;
}
