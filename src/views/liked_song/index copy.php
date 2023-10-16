<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/song_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/table.php");
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UFT-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../public/css/stylee.css">
        <link rel="stylesheet" href="../../../public/css/style.css">
        <link rel="stylesheet" href="../../../public/css/icon.css">
        <link rel="stylesheet" href="../../../public/css/liked.css">

        <?php echo Font(); ?>
        <title>Stopify</title>
    </head>
    <body>
        <div class="whole-wrapper">
            <?php echo SideBar(""); ?>
            <div class="page-wrapper">
                <?php echo icon("vieri"); ?>
                <div class="liked-detail">
                    <img src="../../../public/image/senja.jpg">
                    <div class="liked-detail-text">
                        <h1>PLAYLIST</h1>
                        <h2>Liked Songs</h1>
                    </div>
                </div>
                <div class="songlist">
                    <div class="header_songlist">
                        <h2>Song List</h2>
                    </div>
                    <div class="song_section">
                        <?php echo table() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>