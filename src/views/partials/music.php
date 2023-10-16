<?php
require_once(PROJECT_ROOT_PATH . "/src/models/MusicModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/LikesModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");

function musicDetail($params)
{
    $music_id = $params["music_id"];

    $albumModel = new MusicModel();
    $total_recordsdata = $albumModel->getDetailMusic($music_id);

    $likesModel = new LikesModel();
    $liked = $likesModel->checkLikes($_SESSION["id_user"], $music_id) ? true : false;

    $html = icon($_SESSION["username"]);
    $html .= ' <input type="hidden" id="id_user" name="id_user" value="'.$_SESSION["id_user"].'">';
    $html .= '<h1 style="margin-top: 5vw;">Good morning, ' . $_SESSION["username"] . '</h1>';
    $html .= songDetail($total_recordsdata->image_url, $total_recordsdata->album_title, $total_recordsdata->music_title, $total_recordsdata->genre_name, $total_recordsdata->artist_name, $liked);
    $html .= songPlayer($total_recordsdata->audio_url);

    echo $html;
}

function songDetail($img_url, $album, $title, $genre, $artist, $liked)
{
    $likedStatus = $liked ? "Unlike" : 'Like';

    $html = "
        <div class='play-song-container'>
            <img src='$img_url'  alt='image/none.jpg'>
            <div class='play-song-detail'>
                <h3>$album</h3>
                <h4>$title</h4>
                <br>
                <p>$genre</p>
                <p>$artist</p>
                <button class='love-button' id='likeButton' onclick='handleLoveButtonClick()' >$likedStatus ❤️</button>
            </div>
        </div>
    ";

    return $html;
}

function songPlayer($audio_url)
{   
    $ext = pathinfo($audio_url, PATHINFO_EXTENSION);
    $html = <<< "EOT"
        <div class='audio-player'>
            <audio controls>
                <source src="$audio_url" type="audio/$ext">
            </audio>
        </div>
    ";
    EOT;
    return $html;
}

