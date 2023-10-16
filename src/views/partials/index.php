<?php

include_once(PROJECT_ROOT_PATH . "/src/router/APIRouter.class.php");
include_once(PROJECT_ROOT_PATH . "/src/middlewares/Utils.class.php");

$partials = glob(PROJECT_ROOT_PATH . '/src/views/partials/*.php');
foreach($partials as $partial) {
    include_once($partial);
}

$router = new APIRouter();

$router->get('/element/search-table/', 'searchTable', [Utils::class . '::mergeParams']);
$router->get('/element/albums_pagination/{page}/{limit}', 'albumsPagination');
$router->get('/element/liked_songs/{id_user}/{page}/{limit}', 'likedSong');
$router->get('/element/liked_albums/{id_user}/{page}/{limit}', 'likedAlbum');
$router->get('/element/music_pagination/{id_album}/{page}/{limit}', 'musicRecordByAlbum');
$router->get('/element/music/{music_id}', 'musicDetail');
$router->get('/element/genres_pagination/{page}/{limit}', 'genresPagination');
$router->get('/element/artists_pagination/{page}/{limit}', 'artistPagination');
$router->get('/element/fyp', 'forYourPage');

$router->get('/element/genre-input', 'genreInput');
$router->get('/element/genre-input/{id_genre}', 'genreInput');
$router->get('/element/music-input', 'musicInput');
$router->get('/element/music-input/{id_music}', 'musicInput');
$router->get('/element/album-input', 'albumInput');
$router->get('/element/album-input/{id_album}', 'albumInput');
$router->get('/element/artist-input', 'artistInput');
$router->get('/element/artist-input/{id_artist}', 'artistInput');

$router->run();
