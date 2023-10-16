<?php

function big($img_url, $song_title, $artist, $id_music){
    $html=<<<EOT
        <a href="/music?id=$id_music">
        <img class="first" src="$img_url" alt="image"/>
        <h2>$song_title</h2>
        <p>$artist</p>
        </a>
EOT;
    return $html;
}
function long($img_url, $song_title, $artist, $id_music){
    $html = <<<EOT
    <a href="/music?id=$id_music">        
        <div class="song-item-long">
            <img class="second" src="$img_url" alt='image/none.jpg'/>
            <div class="song-item-container">
                <h4>$song_title</h4>
                <p>$artist</p>
            </div>
        </div>
    </a>
EOT;
  return $html;
}

function medium($img_url, $song_title, $artist, $id_music){
    $html=<<<EOT
    <div class="song-item-medium">
        <a href="/music?id=$id_music">
        <img class="new-song" src=$img_url alt="image"/>
        <h3>$song_title</h3>
        <p>$artist</p>
        </a>
    </div>
EOT;
    return $html;

}