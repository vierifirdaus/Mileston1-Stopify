<?php 
require_once(PROJECT_ROOT_PATH . "/src/controllers/BaseController.class.php");
require_once(PROJECT_ROOT_PATH . "/src/models/UsersModel.class.php");

class UsersController extends BaseController 
{
    protected function __construct() 
    {
        $this->model = new UsersModel();
    }

    public static function login($path_params)
    {
        $body_params = self::getBodyParams();
        $params = array_merge($path_params , $body_params);
        $result = self::getInstance()->model->login($params["email"], $params["password"]);
        if($result)
        {
            self::toResponse(200, "sukses", $result);
        }
        else
        {
            self::toResponse(400, "gagal", $result);
        }
    }

    public static function getUserById($path_params)
    {
        $params = $path_params;
        $result = self::getInstance()->model->getUserById($params["id_user"]);

        self::toResponse(200, "", $result);
    }
    public static function getUserByUsername($path_params)
    {
        $params = $path_params;
        $result = self::getInstance()->model->getUserByUsername($params["username"]);

        self::toResponse(200, "", $result);
    }

    public static function getAllUser($path_params)
    {
        $params = $path_params;
        $result = self::getInstance()->model->getAllUser();

        self::toResponse(200, "", $result);
    }
    
    public static function insertUser($path_params)
    {
        $body_params = self::getBodyParams();
        $params = array_merge($path_params , $body_params);
        $result = self::getInstance()->model->insertUser($params["email"], $params["username"], $params["password"]);

        self::toResponse(200, "sukses", $result);
    }
    public static function deleteUser($path_params) 
    {
        $params = $path_params;
        $result = self::getInstance()->model->deleteUser($params["id_user"]);

        self::toResponse(200, "", $result);
    }
}