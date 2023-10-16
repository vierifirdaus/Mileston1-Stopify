<?php
require_once(PROJECT_ROOT_PATH . "/src/models/AlbumModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");

function albumsPagination($params)
{
    $page = $params["page"];
    $limit = $params["limit"];


    $albumModel = new AlbumModel();
    $total_recordsdata = $albumModel->getAlbumRecords($page, $limit);


    $total_records = count($albumModel->getAllAlbum());

    $total_pages = ceil($total_records / $limit);

    $html = icon($_SESSION["username"]);
    $html .= limit_page($limit);
    $html .= '<div class="container-pagination" id="container-pagination">';
    $html .= albumDisplay($total_recordsdata[0]->id_album, $total_recordsdata[0]->album_image_url, $total_recordsdata[0]->album_title, $total_recordsdata[0]->artist_name);

    for ($i = 1; $i < min($limit, count($total_recordsdata)); $i++) {
        $html .= albumDisplay(
            $total_recordsdata[$i]->id_album,
            $total_recordsdata[$i]->album_image_url,
            $total_recordsdata[$i]->album_title,
            $total_recordsdata[$i]->artist_name
        );
    }
    $html .= '</div>';

    $html.=pagination_item($page,$total_pages);
    echo $html;
}


function albumDisplay($id_album, $album_image, $album_title, $artist){
    $button = $_SESSION["role"] == "admin"? "<div class='edit-btn edit-album'></div>" : null;
    $html=<<<"EOT"
        <div class="song-item-medium" value="$id_album">
            <a href="album?id=$id_album">
                <img class="container-pagination" src="$album_image"  alt="image/none.jpg""/>
                <h3>$album_title</h3>
                <p>$artist</p>
            </a>
            $button
        </div>
    EOT;
    return $html;
}

