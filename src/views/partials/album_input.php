<?php 
require_once(PROJECT_ROOT_PATH . "/src/models/ArtistModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/AlbumModel.class.php");
function albumInput($params) 
{
    $id = $params["id_album"];
    
    if ($id)
    {
        $album_model = new AlbumModel();
        $album = $album_model->getAlbumByAlbumId($id);
        $album_title = $album->album_title;
        $image_url = $album->album_image_url;

        $artist_model = new ArtistModel();
        $artists = $artist_model->getAllArtist();
        $artist_options = "";
        foreach($artists as $artist)
        {
            $name = $artist->name;
            $id_artist = $artist->id_artist;
            $selected = ($album->id_artist == $id_artist) ? "selected" : null;
            $artist_options .= "<option $selected value='$id_artist'>$name</option>";
        }

        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-album" id-album="$id">
            <img id="album-image-preview" src="$image_url"  alt="image/none.jpg"/><br>
            <label for="album-title">Album title</label><br>
            <input type="text" value='$album_title' id="album-title"><br>
            <label for="image">Album cover</label><br>
            <div class="file-input">
                <input type="file" id="input-album-image-url" name="image" accept="image/*">
                <p id="file-input-label">Select album cover</p>
            </div>
            <label for="artist-name">Artist name</label><br>
            <select id="artist-option">
                $artist_options
            </select><br>
            <button class="dialog-button dialog-submit" id="dialog-album-submit-button">Update</button>
            <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
            <button class="dialog-button dialog-delete" id="dialog-album-delete-button">Delete</button>
            </div>
      </div>
      EOT;
    }
    else 
    {
        $artist_model = new ArtistModel();
        $artists = $artist_model->getAllArtist();
        $artist_options = "";
        foreach($artists as $artist)
        {
            $name = $artist->name;
            $id_artist = $artist->id_artist;
            $artist_options .= "<option value='$id_artist'>$name</option>";
        }

        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-album">
                <img id="album-image-preview"  alt="image/none.jpg"/><br>
                <label for="album-title">Album title</label><br>
                <input type="text" id="album-title"><br>
                <label for="image">Album cover</label><br>
                <div class="file-input">
                <input type="file" id="input-album-image-url" name="image" accept="image/*">
                <p id="file-input-label">Select album cover</p>
                </div>
                <label for="artist-name">Artist name</label><br>
                <select id="artist-option">
                    $artist_options
                </select><br>
                <button class="dialog-button dialog-submit" id="dialog-album-submit-button">Add</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
            </div>
        </div>
        EOT;
    }

    echo($html);

}