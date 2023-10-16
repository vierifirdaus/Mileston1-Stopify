<?php 
require_once(PROJECT_ROOT_PATH . "/src/models/MusicModel.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/GenreModel.class.php");


function searchBy()
{


    $html = <<< "EOT"
        <select id="search-by" class="search-by-filter">
            <option value="music.title" selected>Search-by: title</option>
            <option value="artist.name">Search-by: artist</option>
        </select>
    EOT;
    echo($html);
}

function yearFilter()
{
    $model = new MusicModel();
    $years = $model->getAllYear();
    $options = "<option value='all' selected>Year: all</option>";
    foreach ($years as $year)
    {   
        $_year = $year->release_year;
        $options .= "<option value='$_year'>Year: $_year</option>";
    }
    $html = <<< "EOT"
        <select id="year-filter" class="search-by-filter">
            $options
        </select>
    EOT;
    echo($html);
}


function genreFilter()
{
    $model = new GenreModel();
    $genres = $model->getAllGenre();
    $options = "<option value='all' selected>Genre: all</option>";
    foreach ($genres as $genre)
    {   
        $genre_name = $genre->name;
        $options .= "<option value='$genre_name'>Genre: $genre_name</option>";
    }
    $html = <<< "EOT"
        <select id="genre-filter" class="search-by-filter">
            $options
        </select>
    EOT;
    echo($html);
}

function sortBy()
{
    $html = <<< "EOT"
        <select id="sort-by" class="search-by-filter">
            <option value="music.title" selected>Sort-by: title</option>
            <option value="release_date">Sort-by: release date</option>
        </select>
    EOT;
    echo($html);
}

function order()
{
    $html = <<< "EOT"
        <select id="order-by" class="search-by-filter">
            <option value="asc" selected>Order: asc</option>
            <option value="desc">Order: desc</option>
        </select>
    EOT;
    echo($html);
}