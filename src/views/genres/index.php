<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/genre_input.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/genre_card.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/limit_page.css">

    <script src="js/genre.js"></script>
    <?php echo Font(); ?>
    <title>Document</title>
</head>
<body>
    <div class="dialog-section"></div>
    <div class="whole-wrapper">
         <?php echo SideBar("Genres");?>
        <div class="page-wrapper" id="page-wrapper">
            <div class="genre-section">
                <div class="section-header">
                <p class="section-title">Genres</p>        
                <?php if ($_SESSION["role"] == "admin") { echo "<div class='add-genre add-btn'></div>";};?>
                </div>
            <hr>
            <div class="genres-pagination" id="genres">
            </div>
        </div>
    </div>
</body>
</html>
