<?php
include_once(PROJECT_ROOT_PATH . "/src/models/MusicModel.class.php");
include_once(PROJECT_ROOT_PATH . "/src/models/AlbumModel.class.php");
include_once(PROJECT_ROOT_PATH . "/src/models/GenreModel.class.php");

function musicInput($params) 
{
    $id = $params["id_music"];
    echo json_encode($params);
    if ($id)
    {
        $music_model = new MusicModel();
        $music = $music_model->getMusicByMusicId($id);
        $title = $music->title;
        $audio = $music->audio_url;
        $id_album = $music->id_album;
        $id_genre = $music->id_genre;

        $album_model = new AlbumModel();
        $albums = $album_model->getAllAlbum();

        $default_image_url = "";
        $album_options = "";
     
        foreach($albums as $album)
        {
            if ($album->id_album == $id_album) 
            {
                $default_image_url = $album->image_url;
                $selected = "selected";
            }
            else 
            {
                $selected = null;
            }
            $value = $album->id_album;
            $image_url = $album->image_url;
            $album_options .= "<option value='$value' image_url='$image_url' $selected>$album->title</option>"; 
        }

        $genre_model = new GenreModel();
        $genres = $genre_model->getAllGenre();
        $genre_options = "";

        foreach($genres as $genre)
        {
            if ($genre->id_genre == $id_genre) 
            {
                $selected = "selected";
            }
            else 
            {
                $selected = null;
            }
            $value = $genre->id_genre;
            $genre_options .= "<option $selected value='$value'>$genre->name</option>"; 
        }

        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-music" id-music="$id">
                <img id="album-image-preview" src="$default_image_url"  alt="image/none.jpg"/><br>
                <label for="music-title">Music title</label><br>
                <input type="text" id="music-title" value="$title"><br>
                <label for="song">Audio file</label><br>
                <div class="file-input">
                <input type="file" id="input-music-audio-url" name="music" accept="audio/*">
                <p id="file-input-label">Select audio file</p>
                </div>
                <label for="album-option">Album</label><br>
                <select id="album-option">
                    $album_options
                </select><br>
                <label for="genre-option">Genre</label><br>
                <select id="genre-option">
                    $genre_options
                </select><br>
                <button class="dialog-button dialog-submit" id="dialog-music-submit-button">Update</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
                <button class="dialog-button dialog-delete" id="dialog-music-delete-button">Delete</button>
            </div>
        </div>
        EOT;
    }
    else 
    {        
        $music_model = new MusicModel();
        $music = $music_model->getMusicByMusicId($id);
        $title = $music->title;
        $image_url = $music->image_url;
        $id_album = $music->id_album;
        $id_genre = $music->id_genre;

        $album_model = new AlbumModel();
        $albums = $album_model->getAllAlbum();
        $album_options = "";
        foreach($albums as $album)
        {
            $value = $album->id_album;
            $image_url = $album->image_url;
            $album_options .= "<option value='$value' image_url='$image_url'>$album->title</option>"; 
        }

        $genre_model = new GenreModel();
        $genres = $genre_model->getAllGenre();
        $genre_options = "";
        foreach($genres as $genre)
        {
            $value = $genre->id_genre;
            $genre_options .= "<option value='$value'>$genre->name</option>"; 
        }
        
        $html = <<< "EOT"
        <div class="dialog-wrapper" >
            <div class="dialog" id="dialog-music">
                <img id="album-image-preview"  alt="image/none.jpg"/><br>
                <label for="music-title">Music title</label><br>
                <input type="text" id="music-title"><br>
                <label for="song">Audio file</label><br>
                <div class="file-input">
                <input type="file" id="input-music-audio-url" name="music" accept="audio/*">
                <p id="file-input-label">Select audio file</p>
                </div>
                <label for="album-option">Album</label><br>
                <select id="album-option">
                    $album_options
                </select><br>
                <label for="genre-option">Genre</label><br>
                <select id="genre-option">
                    $genre_options
                </select><br>
                <button class="dialog-button dialog-submit" id="dialog-music-submit-button">Add</button>
                <button class="dialog-button" id="dialog-cancel-button">Cancel</button>
            </div>
        </div>
        EOT;
    }
    echo($html);
}