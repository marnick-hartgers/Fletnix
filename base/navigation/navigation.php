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
        ],
    ];
    foreach ($genres as $genre) {
        $return[] = [
            "title" => $genre,
            "href" => "/browse/" . $genre,
            "subitems" => [],
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
            "subitems" => []
        ],
        [
            "title" => "Browse",
            "href" => "/browse",
            "subitems" => getMovieNavigation()
        ],
        [
            "title" => "Over ons",
            "href" => "/about",
            "subitems" => [],
        ],
        [
            "title" => "Abonnement",
            "href" => "/subscription",
            "subitems" => [],
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
