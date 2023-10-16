<?php
require_once(PROJECT_ROOT_PATH ."/src/models/BaseModel.class.php");

class LikesModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "likes";
    }
  
    public function likes($id_user, $id_music)
    {
        $this->db->query('INSERT INTO ' . $this->table . ' (id_user, id_music) VALUES (:id_user, :id_music)');
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_music', $id_music);
        return $this->db->execute();
    }

    public function checkLikes($id_user, $id_music)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user AND id_music = :id_music');
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_music', $id_music);
        return $this->db->resultSet();
    }
    
    public function unlikes($id_user, $id_music)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_user = :id_user AND id_music = :id_music');
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_music', $id_music);
        return $this->db->resultSet();
    }

    public function getDetailLikesById($id_user)
    {
        if($id_user != $_SESSION["id_user"]){
            return false;
        }
        $this->db->query(
            'SELECT 
                music.title as music_title, 
                genre.name as genre_name, 
                album.title as album_title, 
                artist.name as artist_name,
                music.release_date as release_date
            FROM 
                likes
            JOIN
                music ON likes.id_music = music.id_music
            JOIN 
                album ON music.id_album = album.id_album
            JOIN
                genre ON music.id_genre = genre.id_genre
            JOIN
                artist on artist.id_artist = album.id_artist
            WHERE 
                id_user = :id_user;
        ');
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    public function getRecordDetailsLikes($id_user,$current_page,$limit){
        $offset = ($current_page - 1) * $limit;
        if($id_user != $_SESSION["id_user"]){
            return false;
        }
        $this->db->query(
            'SELECT 
                music.id_music as id_music,
                music.title as music_title, 
                genre.name as genre_name, 
                album.title as album_title, 
                artist.name as artist_name,
                music.release_date as release_date
            FROM 
                likes
            JOIN
                music ON likes.id_music = music.id_music
            JOIN 
                album ON music.id_album = album.id_album
            JOIN
                genre ON music.id_genre = genre.id_genre
            JOIN
                artist on artist.id_artist = album.id_artist
            WHERE 
                id_user = :id_user
            LIMIT :limit OFFSET :offset;
        ');
        $this->db->bind('id_user', $id_user);
        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);
        return $this->db->resultSet();
    }
}


