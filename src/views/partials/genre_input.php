<?php
require_once(PROJECT_ROOT_PATH . "/src/models/GenreModel.class.php");
function genreInput($params=null)
{
    $id = $params["id_genre"];

    if ($id) 
    {
        $model = new GenreModel();
        $genre = $model->getGenreByGenreId($id);
        $genre_name = $genre->name;
        $image_url = $genre->image_url;
        $color = $genre->color;

        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-genre" id-genre="$id">
                <div class="genre-card" id="genre-card-preview" style="background-color:$color;">
                <p id="genre-name-preview">$genre_name</p>
                <img id="genre-image-preview" src="$image_url"  alt="image/none.jpg"/><br>
                </div>
                <label for="genre-name">Genre name</label><br>
                <input type="text" id="genre-name" value="$genre_name"><br>
                <label for="genre">Genre image</label><br>
                <div class="file-input">
                <input type="file" id="input-genre-image-url" name="genre" accept="image/*"/>
                <p id="file-input-label">Select genre image</p>
                </div>
                <label for="genre-color">Color</label><br>
                <input type="color" id="genre-color" value="$color" /><br>
                <button class="dialog-button dialog-submit" id="dialog-genre-submit-button">Update</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
                <button class="dialog-button dialog-delete" id="dialog-genre-delete-button">Delete</button>
            </div>
        </div>
        EOT; 
    }    
    else 
    {
        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-genre">
                <div class="genre-card" id="genre-card-preview">
                <p id="genre-name-preview"></p>
                <img id="genre-image-preview"  alt="image/none.jpg"/><br>
                </div>
                <label for="genre-name">Genre name</label><br>
                <input type="text" id="genre-name"><br>
                <label for="genre">Genre image</label><br>
                <div class="file-input">
                <input type="file" id="input-genre-image-url" name="genre" accept="image/*"/>
                <p id="file-input-label">Select genre image</p>
                </div>
                <label for="genre-color">Color</label><br>
                <input type="color" id="genre-color" value="#3271a8" /><br>
                <button class="dialog-button dialog-submit" id="dialog-genre-submit-button">Add</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
            </div>
        </div>
        EOT;
    }                                
    echo($html);
}
