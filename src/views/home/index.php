<?php
require_once(PROJECT_ROOT_PATH . "/src/views/partials/side_bar.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/song_item.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/icon.php");
require_once(PROJECT_ROOT_PATH . "/src/views/partials/font.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/icon.css">
    <link rel="stylesheet" href="css/song.css">

    <?php echo Font(); ?>
    <title>Home Page</title>
    <script src="js/home.js"></script>
<body>
    <div class="whole-wrapper">
        <?php echo SideBar("Home"); ?>
        <div class="page-wrapper">
            <?php echo icon($_SESSION["username"]); ?>
            <h1 style="margin-top: 5vw;">Good morning, <?php echo $_SESSION["username"] ?></h1>
            <br>
            <div class="fyp" id="fyp"></div>
            <!-- <h1>Recommended for you</h1>
            <div class="recommended-container">
                    <div class="top-song-first">
                    </div>
                <div class="top-song-second"></div>
            </div>
            <h3>New Release Song</h3>
            <div class="new-song"></div> -->
        </div>
    </div>
</body>
</html>
