<?php
require_once(PROJECT_ROOT_PATH . "/src/models/AlbumModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/tables.php");

function musicRecordByAlbum($params)
{
    $page = $params["page"];
    $limit = $params["limit"];
    $id_album = $params["id_album"];


    $albumModel = new AlbumModel();
    $total_recordsdata = $albumModel->getMusicRecords($page,$limit,$id_album);
    
    $total_records = count($albumModel->getMusicByAlbumId($id_album));
    
    $total_pages = ceil($total_records / $limit);

    $detailAlbum = $albumModel->getAlbumByAlbumId($id_album);
    $html = icon($_SESSION["username"]);
    $html .= albumContainer($detailAlbum->album_image_url, $detailAlbum->album_title, $detailAlbum->artist_name);
    $html .= limit_page($limit);

    $html .= '<div class="table-container" id="container-pagination">';
    $heading=["Title Song","Genre ","Realease Year"];
    $dataTable=[];
    foreach($total_recordsdata as $data){
        $href="<a href='/music?id=".$data->id_music."'>".$data->music_title."</a>";
        $dataTable[]=[
            $href,
            $data->genre_name,
            substr($data->release_date,0,4)
        ];
    }
    $html.=tables($heading,$dataTable);
    $html .= '</div>';

    $html.=pagination_item($page,$total_pages);
    echo $html;
}
