<?php 

include_once(PROJECT_ROOT_PATH . "/src/models/ArtistModel.class.php");
function artistInput($params)
{
    $id = $params["id_artist"];
    if ($id)
    {
        $model = new ArtistModel();
        $artist = $model->getArtistByArtistId($id);
        $name = $artist->name;
        $image_url = $artist->image_url;
        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-artist" id-artist="$id">
            <img id="artist-image-preview" src="$image_url"  alt="image/none.jpg"/><br>
            <label for="artist-name">Artist name</label><br>
            <input type="text" id="artist-name" value="$name"><br>
            <label for="image">Artist picture</label><br>
            <div class="file-input">
                <input type="file" id="input-artist-image-url" name="image" accept="image/*">
                <p id="file-input-label">Select artist picture</p>
            </div>
            <button class="dialog-button dialog-submit" id="dialog-artist-submit-button">Update</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
                <button class="dialog-button dialog-delete" id="dialog-artist-delete-button">Delete</button>
            </div>
        </div>
        EOT;
    }
    else 
    {
        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-artist">
            <img id="artist-image-preview"  alt="image/none.jpg"/><br>
            <label for="artist-name">Artist name</label><br>
            <input type="text" id="artist-name"><br>
            <label for="image">Artist picture</label><br>
            <div class="file-input">
                <input type="file" id="input-artist-image-url" name="image" accept="image/*">
                <p id="file-input-label">Select artist picture</p>
            </div>
            <button class="dialog-button dialog-submit" id="dialog-artist-submit-button">Add</button>
            <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
            </div>
        </div> 
        EOT;
    }
    echo($html);
}