<?php 
require_once(PROJECT_ROOT_PATH . "/src/controllers/BaseController.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/LikesModel.class.php");

class LikesController extends BaseController 
{
    protected function __construct() 
    {
        $this->model = new LikesModel();
    }

    public static function likes($path_params)
    {
        $query_params = self::getQueryParams();
        $params = array_merge($path_params, $query_params);
        $result = self::getInstance()->model->likes($params["id_user"], $params["id_music"]);

        self::toResponse(200, "", $result);
    }
    
    public static function unlikes($path_params)
    {
        $query_params = self::getQueryParams();
        $params = array_merge($path_params, $query_params);
        $result = self::getInstance()->model->unlikes($params["id_user"], $params["id_music"]);

        self::toResponse(200, "", $result);
    }
    public static function getDetailLikesById($path_params)
    {
        $query_params = self::getQueryParams();
        $params = array_merge($path_params, $query_params);
        $result = self::getInstance()->model->getDetailLikesById($params["id_user"]);

        self::toResponse(200, "", $result);
    }
    public static function checkLikes($path_params)
    {
        $query_params = self::getQueryParams();
        $params = array_merge($path_params, $query_params);
        $result = self::getInstance()->model->checkLikes($params["id_user"], $params["id_music"]);

        self::toResponse(200, "", $result);
    }
    public static function getRecordDetailsLikes($path_params)
    {
        $query_params = self::getQueryParams();
        $params = array_merge($path_params, $query_params);
        $result = self::getInstance()->model->getRecordDetailsLikes($params["id_user"],$params["current_page"],$params["limit"]);

        self::toResponse(200, "", $result);
    }
}
