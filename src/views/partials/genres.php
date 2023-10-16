<?php
require_once(PROJECT_ROOT_PATH . "/src/models/AlbumModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/genre_card.php");

function genresPagination($params)
{
    $page = $params["page"];
    $limit = $params["limit"];


    $albumModel = new GenreModel();
    $total_recordsdata = $albumModel->getGenreRecors($page, $limit);


    $total_records = count($albumModel->getAllGenre());

    $total_pages = ceil($total_records / $limit);

    $html = limit_page($limit);

    $html .= "<div class='genres'>";
        
    foreach($total_recordsdata as $genre){
        $html.=genreCard($genre->id_genre);
    }

    $html .= "</div>";

    $html.=pagination_item($page,$total_pages);
    echo $html;
}