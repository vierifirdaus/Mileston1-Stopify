<?php 
require_once(PROJECT_ROOT_PATH . "/src/controllers/BaseController.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/ArtistModel.class.php");

class ArtistController extends BaseController 
{
    protected function __construct() 
    {
        $this->model = new ArtistModel();
    }

    public static function getAllArtist($path_params)
    {
        $result = self::getInstance()->model->getAllArtist();

        self::toResponse(200, "", $result);
    }
  
    public static function getArtistByArtistID($path_params)
    {   
        $params = $path_params;
        
        $result =  self::getInstance()->model->getArtistByArtistID($params["id_artist"]);
        self::toResponse(200, "", $result);
    }
    
    public static function editArtist($path_params)
    {
        $body_params = self::getBodyParams();
        $params = array_merge($body_params, $path_params);

        $result =  self::getInstance()->model->editArtist($params["id_artist"], $params["artist_name"], $params["image"]);
        self::toResponse(200, "Artist edited successfully!", $result);
    }
  
    public static function insertArtist($path_params) 
    {
        $body_params = self::getBodyParams();
        $params = array_merge($body_params, $path_params);

        $result = self::getInstance()->model->insertArtist($params["artist_name"], $params["image"]);
        self::toResponse(200, "Artist added successfully!", $result);
    }
  
    public static function deleteArtist($path_params)
    {
        $params = $path_params;
        $result = self::getInstance()->model->deleteArtist($params["id_artist"]);

        self::toResponse(200, "Artist deleted successfully!", $result);
    }
}