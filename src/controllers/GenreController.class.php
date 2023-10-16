<?php 
require_once(PROJECT_ROOT_PATH . "/src/controllers/BaseController.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/GenreModel.class.php");

class GenreController extends BaseController 
{
    protected function __construct() 
    {
        $this->model = new GenreModel();
    }
  
    public static function getAllGenre($path_params)
    {
		$params = $path_params;
		$result = self::getInstance()->model->getAllGenre();

        self::toResponse(200, "", $result);
    }
  
    public static function getGenreByGenreId($path_params)
    {
		$params = $path_params;
		$result = self::getInstance()->model->getGenreByGenreID($params["id"]);

		self::toResponse(200, "", $result);
    }
    
    public static function editGenre($path_params) 
	{
		$body_params = self::getBodyParams();
		$params = array_merge($path_params, $body_params);
		$result = self::getInstance()->model->editGenre($params["id_genre"], $params["name"], $params["image"], $params["color"]);

		self::toResponse(200, "Genre edited successfully!", $result);
    }
  
    public static function insertGenre($path_params) 
	{
		$body_params = self::getBodyParams();
		$params = array_merge($path_params, $body_params);
		$result = self::getInstance()->model->insertGenre($params["name"], $params["image"], $params["color"]);

		self::toResponse(200, "Genre added successfully!", $result);
    }
  
    public static function deleteGenre($path_params)
	{
		$params = $path_params;
		$result = self::getInstance()->model->deleteGenre($params["id_genre"]);

		self::toResponse(200, "Genre deleted successfully!", $result);
    }
}