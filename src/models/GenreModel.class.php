<?php
require_once(PROJECT_ROOT_PATH ."/src/models/BaseModel.class.php");

class GenreModel extends BaseModel
{
    public function __construct()
    {
		parent::__construct();
		$this->table = 'genre';    
	}
  
	public function getMaxIdGenre()
    {
		$this->db->query('SELECT id_genre FROM ' . $this->table . ' ORDER BY id_genre DESC LIMIT 1');
		return $this->db->single()->id_genre;
    }

    public function getAllGenre()
    {
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->resultSet();
    }
	public function getGenreRecors($current_page,$limit)
    {
        $offset = ($current_page - 1) * $limit;
        $this->db->query(
        'SELECT DISTINCT
            id_genre
        FROM
            genre
        LIMIT :limit OFFSET :offset
        ');
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        return $this->db->resultSet();

    }
  
    public function getGenreByGenreId($id_genre)
    {
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_genre = :id_genre');
		$this->db->bind('id_genre', $id_genre);
		return $this->db->single();
    }
    
    public function editGenre($id_genre, $name, $image, $color) 
	{
        if (!$image)
        {
            throw new BadRequestException("Image cannot be empty!");
        }

		$upload_dir = "storage/album_image/"; 
        $upload_path = $upload_dir . $id_genre. "_" . $name . "." . self::getExt($image);
        $image_url = $upload_path;
		self::uploadFile($upload_path, $image);

		$this->db->query('UPDATE ' . $this->table . ' SET name = :name, image_url = :image_url, color = :color WHERE id_genre = :id_genre');
		$this->db->bind('id_genre', $id_genre);
		$this->db->bind('name', $name);
		$this->db->bind('image_url', $image_url);
		$this->db->bind('color', $color);
		$this->db->execute();
		return $this->db->rowCount();
    }
  
    public function insertGenre($name, $image, $color) 
	{
        if (!$image)
        {
            throw new BadRequestException("Image cannot be empty!");
        }

		$upload_dir = "storage/album_image/"; 
		$id_genre = $this->getMaxIdGenre() + 1;
        $upload_path = $upload_dir . $id_genre. "_" . $name . "." . self::getExt($image);
        $image_url = $upload_path;
		self::uploadFile($upload_path, $image);
		
		$this->db->query('INSERT INTO ' . $this->table . ' (name, image_url, color) VALUES (:name, :image_url, :color)');
		$this->db->bind('name', $name);
		$this->db->bind('image_url', $image_url);
		$this->db->bind('color', $color);
		$this->db->execute();
		return $this->db->rowCount();
    }
  
    public function deleteGenre($id_genre)
	{
		$delete_tuple = $this->getGenreByGenreId($id_genre);

		$this->db->query('DELETE FROM ' . $this->table . ' WHERE id_genre = :id_genre');
		$this->db->bind('id_genre', $id_genre);
		$this->db->execute();

		unlink($delete_tuple->image_url);
		return $this->db->rowCount();
    }
}
