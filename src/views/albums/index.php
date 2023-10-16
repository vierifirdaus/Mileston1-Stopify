<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/song_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/limit_page.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/pagination_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/albums.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pagination.css">
    <link rel="stylesheet" href="css/song.css">
    <link rel="stylesheet" href="css/icon.css">
    <script src="js/album_input.js"></script>
    <?php echo Font(); ?>
    <title>All Album</title>
</head>
<body>
    <div class="dialog-section"></div>
    <div class="whole-wrapper">
         <?php echo SideBar("Albums");?>
         <div class="page-wrapper" id="page-wrapper">
            <div class="section-header">
                <p class="section-title"> Albums </p>  
                <?php if ($_SESSION["role"] == "admin") { echo "<div class='add-album add-btn'></div>";};?>
            </div><hr>
            <div id="album-items">
                
            </div>
        </div>
    </div>
</body>
</html>
<script src="js/albums.js"></script>
