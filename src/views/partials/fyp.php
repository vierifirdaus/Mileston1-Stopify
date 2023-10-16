<?php
require_once(PROJECT_ROOT_PATH . "/src/models/MusicModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/song_item.php");


function forYourPage()
{
    $musicModel = new MusicModel();
    $total_recordsdata1 = $musicModel->getRandomDetailMusic();

    $html  = '<div class="recommended-container">';
    $html .= '<div class="top-song-first">';
    $html .= big($total_recordsdata1[0]->image_url, $total_recordsdata1[0]->music_title, $total_recordsdata1[0]->artist_name, $total_recordsdata1[0]->id_music);
    $html .= '</div>';
    $html .= '<div class="top-song-second">';
    $html .= long($total_recordsdata1[1]->image_url, $total_recordsdata1[1]->music_title, $total_recordsdata1[1]->artist_name, $total_recordsdata1[1]->id_music);
    $html .= long($total_recordsdata1[2]->image_url, $total_recordsdata1[2]->music_title, $total_recordsdata1[2]->artist_name, $total_recordsdata1[2]->id_music);
    $html .= long($total_recordsdata1[3]->image_url, $total_recordsdata1[3]->music_title, $total_recordsdata1[3]->artist_name, $total_recordsdata1[3]->id_music);
    $html .= long($total_recordsdata1[4]->image_url, $total_recordsdata1[4]->music_title, $total_recordsdata1[4]->artist_name, $total_recordsdata1[4]->id_music);
    $html .= '</div>';
    $html .= '</div>';

    $newSong = new MusicModel();
    $total_recordsdata2 = $newSong->getFiveNewSong();

    $html .= '<h3>New Release Song</h3>';
    $html .= '<div class="new-song">';
    $html .= medium($total_recordsdata2[0]->image_url, $total_recordsdata2[0]->music_title, $total_recordsdata2[0]->artist_name, $total_recordsdata2[0]->id_music);
    $html .= medium($total_recordsdata2[1]->image_url, $total_recordsdata2[1]->music_title, $total_recordsdata2[1]->artist_name, $total_recordsdata2[1]->id_music);
    $html .= medium($total_recordsdata2[2]->image_url, $total_recordsdata2[2]->music_title, $total_recordsdata2[2]->artist_name, $total_recordsdata2[2]->id_music);
    $html .= medium($total_recordsdata2[3]->image_url, $total_recordsdata2[3]->music_title, $total_recordsdata2[3]->artist_name, $total_recordsdata2[3]->id_music);
    
    echo $html;
}