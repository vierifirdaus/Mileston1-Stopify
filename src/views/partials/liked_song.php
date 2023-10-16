<?php
require_once(PROJECT_ROOT_PATH . "/src/models/LikesModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/tables.php");

function likedSong($params)
{
    $page = $params["page"];
    $limit = $params["limit"];
    $id_user = $params["id_user"];

    if($id_user!=$_SESSION["id_user"]){
        header("Location: /");
    }


    $albumModel = new LikesModel();
    $total_recordsdata = $albumModel->getRecordDetailsLikes($id_user,$page,$limit);
    
    $total_records = count($albumModel->getDetailLikesById($id_user));
    
    $total_pages = ceil($total_records / $limit);

    $html = icon($_SESSION["username"]);
    $liked = '<div class="liked-detail">
                    <img src="image/senja.jpg"  alt="image/none.jpg">
                    <div class="liked-detail-text">
                        <h1>PLAYLIST</h1>
                        <h2>Liked Songs</h1>
                    </div>
                </div>';
    $html .= $liked;
    $html .= limit_page($limit);

    $html .= '<div class="table-container" id="container-pagination">';
    $heading = ["Title Song","Genre ","Album","Artist","Realease Year"];
    $dataTable=[];
    foreach($total_recordsdata as $data){
        $href="<a href='/music?id=".$data->id_music."'>".$data->music_title."</a>";
        $dataTable[]=[
            $href,
            $data->genre_name,
            $data->album_title,
            $data->artist_name,
            $data->release_date
        ];
    }
    $html.=tables($heading,$dataTable);
    $html .= '</div>';

    $html.=pagination_item($page,$total_pages);
    echo $html;
}
