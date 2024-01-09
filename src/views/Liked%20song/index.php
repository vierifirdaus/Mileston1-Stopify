<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/song_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/table.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/liked_song.php");
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UFT-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/icon.css">
        <link rel="stylesheet" href="css/liked.css">
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/pagination.css">

        <?php echo Font(); ?>
        <title>Stopify - Liked Song</title>
    </head>
    <body>
        <input type="hidden" id="custId" name="custId" value="<?php echo $_SESSION["id_user"] ?>">
        <div class="whole-wrapper">
            <?php echo SideBar("Liked song"); ?>
            <div class="page-wrapper" id="page-wrapper">
            </div>
        </div>
    </div>
    </body>
</html>
<script src="js/liked.js"></script>