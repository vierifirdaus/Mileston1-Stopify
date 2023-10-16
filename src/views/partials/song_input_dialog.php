<?php 

function SongInputDialog() {
  $html = <<< "EOT"
    <div class="dialog-wrapper">
      <div class="dialog">
        <form>
          <label for="song-title">Song title</label><br>
          <input type="text" id="song-title" name="song-title"><br>
          <label for="artist">Artist</label><br>
          <input type="text" id="Artist" name="artist"><br>
          <label for="album">Album</label><br>
          <input type="text" id="album" name="album"><br>
          <label for="genre">Genre</label><br>
          <input type="text" id="genre" name="genre"><br>
          <input type="submit" value="Update">
          <input type="button" onclick="closeDialog()" value="Cancel">
          <input type="submit" value="Delete">
        </form> 
      </div>
    </div>
  EOT;
  return $html;
}
