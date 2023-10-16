<?php
require_once(PROJECT_ROOT_PATH ."/src/models/BaseModel.class.php");

class MusicModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
		$this->table = "music";
	}

	public function getMaxIdMusic()
    {
		$this->db->query('SELECT id_music FROM ' . $this->table . ' ORDER BY id_music DESC LIMIT 1');
		return $this->db->single()->id_music;
    }

	public function getAllMusic()
	{
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
	}

	public function getRandomDetailMusic()
	{
		$this->db->query(
			'SELECT 
				music.id_music AS id_music,
				album.image_url AS image_url,
				album.title AS album_title,
				music.title AS music_title,
				genre.name AS genre_name,
				artist.name AS artist_name,
				music.audio_url AS audio_url,
				EXTRACT(YEAR FROM music.release_date) AS release_year
			FROM 
				music
			JOIN 
				album ON music.id_album = album.id_album
			JOIN 
				genre ON music.id_genre = genre.id_genre
			JOIN 
				artist ON album.id_artist = artist.id_artist
			ORDER BY RANDOM()
			LIMIT 10;'
		);

		return $this->db->resultSet();
	}


	public function getFiveNewSong()
	{
		$this->db->query(
			'SELECT 
				music.id_music AS id_music,
				album.image_url AS image_url,
				album.title AS album_title,
				music.title AS music_title,
				genre.name AS genre_name,
				artist.name AS artist_name,
				music.audio_url AS audio_url,
				EXTRACT(YEAR FROM music.release_date) AS release_year
			FROM 
				music
			JOIN 
				album ON music.id_album = album.id_album
			JOIN 
				genre ON music.id_genre = genre.id_genre
			JOIN 
				artist ON album.id_artist = artist.id_artist
			ORDER BY 
				music.release_date DESC
			LIMIT 5;
		');
		return $this->db->resultSet();
	}

	public function getMusicByMusicId($id_music)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_music = :id_music');
		$this->db->bind('id_music', $id_music);
		return $this->db->single();
	}

	public function getDetailMusic($id_music)
	{
		$this->db->query(
			'SELECT 
				album.image_url AS image_url,
				album.title AS album_title,
				music.title AS music_title,
				genre.name AS genre_name,
				artist.name AS artist_name,
				music.audio_url AS audio_url
			FROM 
				music
			JOIN 
				album ON music.id_album = album.id_album
			JOIN 
				genre ON music.id_genre = genre.id_genre
			JOIN 
				artist ON album.id_artist = artist.id_artist
			WHERE 
				music.id_music = :id_music;
		');
		$this->db->bind('id_music', $id_music);
		return $this->db->single();
	}

	public function editMusic($title, $id_genre, $audio, $id_album, $id_music)
	{
        if (!$audio)
        {
            throw new BadRequestException("Audio cannot be empty!");
        }

		$upload_dir = "storage/music_audio/"; 
        $upload_path = $upload_dir . $id_music. "_" . $title . "." . self::getExt($audio);
        $audio_url = $upload_path;
		self::uploadFile($upload_path, $audio);

		$this->db->query('UPDATE ' . $this->table . ' SET title = :title, id_genre = :id_genre, audio_url = :audio_url, id_album = :id_album WHERE id_music = :id_music');
		$this->db->bind('title', $title);
		$this->db->bind('id_genre', $id_genre);
		$this->db->bind('audio_url',$audio_url);
		$this->db->bind('id_album', $id_album);
		$this->db->bind('id_music', $id_music);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function insertMusic($title, $id_genre, $audio, $id_album) 
	{
        if (!$audio)
        {
            throw new BadRequestException("Audio cannot be empty!");
        }


		$upload_dir = "storage/music_audio/"; 
		$id_music = $this->getMaxIdMusic() + 1;
        $upload_path = $upload_dir . $id_music. "_" . $title . "." . self::getExt($audio);
        $audio_url = $upload_path;
		self::uploadFile($upload_path, $audio);

		$this->db->query('INSERT INTO ' . $this->table . ' (title, id_genre, audio_url, id_album) VALUES (:title, :id_genre, :audio_url, :id_album)');
		$this->db->bind('title', $title);
		$this->db->bind('id_genre', $id_genre);
		$this->db->bind('audio_url',$audio_url);
		$this->db->bind('id_album', $id_album);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function searchMusic($sub_str, $sub_str_param, $year, $genre, $sort_by, $current_page, $limit) {
		
		$sub_str_filter = "UPPER($sub_str_param) LIKE UPPER('$sub_str%')";
		$genre_filter = ($genre == "all") ? "TRUE" : "genre.name = '$genre'";
		$year_filter = ($year == "all") ? "TRUE" : "EXTRACT(YEAR FROM music.release_date) = '$year'";
		$order = $sort_by ? "ORDER BY $sort_by" : null; 
		$offset = ($current_page - 1) * $limit;
	
		$this->db->query(
			"SELECT 
				music.id_music AS id_music,
				album.image_url AS image_url,
				album.title AS album_title,
				music.title AS music_title,
				genre.name AS genre_name,
				artist.name AS artist_name,
				music.audio_url AS audio_url,
				EXTRACT(YEAR FROM music.release_date) AS release_year
			FROM 
				music
			JOIN 
				album ON music.id_album = album.id_album
			JOIN 
				genre ON music.id_genre = genre.id_genre
			JOIN 
				artist ON album.id_artist = artist.id_artist
			WHERE 
				$sub_str_filter AND
				$genre_filter AND
				$year_filter
			$order
			LIMIT :limit OFFSET :offset;"
		);
		$this->db->bind(':limit', $limit);
		$this->db->bind(':offset', $offset);
	
		return $this->db->resultSet();
	}	

	public function deleteMusic($id_music)
	{
		$this->db->query('DELETE FROM ' . $this->table . ' WHERE id_music = :id_music');
		$this->db->bind('id_music', $id_music);
		$this->db->execute();
		return $this->db->rowCount();
	}

	public function getAllYear() 
	{
		$this->db->query('
		SELECT DISTINCT 
			EXTRACT(YEAR FROM release_date) as release_year
		FROM music
		ORDER BY release_year DESC;

		');
		
		return $this->db->resultSet();
	}
}

