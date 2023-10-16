<?php
require_once(PROJECT_ROOT_PATH . "/src/models/ArtistModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/artist_card.php");

function artistPagination($params)
{
    $page = $params["page"];
    $limit = $params["limit"];


    $albumModel = new ArtistModel();
    $total_recordsdata = $albumModel->getArtistRecords($page, $limit);


    $total_records = count($albumModel->getAllArtist());

    $total_pages = ceil($total_records / $limit);

    $html = limit_page($limit);
    
    $html .= "<div class='artist-result'>";

    foreach($total_recordsdata as $genre){
        $html.=artistCard($genre->id_artist);
    }
    $html .= "</div>";

    $html.=pagination_item($page,$total_pages);
    echo $html;
}