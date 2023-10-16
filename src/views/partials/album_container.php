

<?php
function AlbumContainer($img_url, $album_title, $artist) {
    $html = <<<"EOT"
    <div class="album-container">
        <div class="img-album">
            <img src=$img_url  alt="image/none.jpg">
        </div>
        <div class="album-detail">
            <h3>$album_title</h3>
            <p>$artist</p>
        </div>
    </div>
    EOT;

    return $html;
}
