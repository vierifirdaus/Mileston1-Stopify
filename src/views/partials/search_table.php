<?php
include_once(PROJECT_ROOT_PATH . "/src/models/MusicModel.class.php");

function searchTable($params)
{

    echo json_encode($params);

    $model = new MusicModel();
    $musics = $model->searchMusic($params["sub_str"], $params["sub_str_param"], $params["year"], $params["genre"],  $params["sort_by"], $params["current_page"], $params["limit"]);
    $limit = $params["limit"];
    // // $musics = $model->searchMusic($title, $genre, $artist, $year, $sort_by, $current_page, $limit);
    // echo json_encode($musics);
    $trs = "";
    foreach ($musics as $i=>$music) 
    {
        $title = $music->music_title;
        $name = $music->artist_name;
        $genre = $music->genre_name;
        $year = $music->release_year;
        $id = $music->id_music;
        $button = $_SESSION["role"] == "admin"? "<div class='edit-btn edit-music' value='$id'></div>" : null;

        $trs .= <<< "EOT"
        <tr>
            <td>$i</td>
            <td><a href="/music?id=$id">$title</a></td>
            <td>$name</td>
            <td>$genre</td>
            <td>$year</td>
            <td>$button</td>
        </tr>

        EOT;
    }

    
    $html=<<<EOT
        <table class="search-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                $trs
            </tbody>
        </table>
    EOT;
    $length = count($model->searchMusic($params["sub_str"], $params["sub_str_param"], $params["year"], $params["genre"],  $params["sort_by"], 1, 1000));
    $html .= pagination_item($params["current_page"], ceil($length / $limit));
    echo($html);
}