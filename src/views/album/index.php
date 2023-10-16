<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/album_container.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/album.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/album.css">
    <link rel="stylesheet" href="css/icon.css">
    <link rel="stylesheet" href="css/pagination.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/limit_page.css">

    <?php echo Font(); ?>
    
    <title>Stopfiy Album</title>
</head>
<body>
    <div class="whole-wrapper">
        <?php echo SideBar($album);?>
        <div class="page-wrapper" id="page-wrapper">
            
        </div>
    </div>
</body>
</html>
<script src="js/album.js"></script>
