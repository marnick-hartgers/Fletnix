<?php
function getNavigationTree(){
    $navigationItems = [
        [
            "title"=>"Home",
            "href"=>"/",
            "subitems"=>[]
        ],
        [
            "title"=>"Movies",
            "href"=>"/movies",
            "subitems"=>[
                [
                    "title"=>"Actie",
                    "href"=>"/movies/actie",
                    "subitems"=>[]
                ],
                [
                    "title"=>"Sci-fi",
                    "href"=>"/movies/actie",
                    "subitems"=>[]
                ]
            ]
        ]
    ];
    return $navigationItems;
}


function pageNavigation(){
    $navigationItems = getNavigationTree();
    $navString = "<ul>";
    foreach($navigationItems as $item){
        $navString = $navString . buildNavigationItem($item);
    }
    $navString = $navString . "</ul>";
    return $navString;
}

function buildNavigationItem($navItem){
    $title = $navItem["title"];
    $href = $navItem["href"];
    $itemString = "
    <li>
        <a href='$href' >$title</a>
        <ul>";
    foreach($navItem["subitems"] as $subitem){
        $itemString = $itemString . buildNavigationItem($subitem);
    }

    $itemString = $itemString . "</ul></li>";
    return $itemString;
}

?>