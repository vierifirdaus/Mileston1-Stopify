<?php
require_once(PROJECT_ROOT_PATH ."/src/db/Database.class.php");
// use Database;
class BaseModel 
{
    protected $table;
    protected $db;
  
    protected function __construct()
    {
		$this->db = new Database();
    }

    protected static function getExt($file)
    {
        $file_info = pathinfo($file["name"]);
        $ext = isset($file_info['extension']) ? $file_info['extension'] : '';
        return $ext;
    }

    protected static function uploadFile($upload_path, $file) 
    {
        if ($file["error"] !== UPLOAD_ERR_OK)
        {
            throw new UnprocessableContentException("File error when received!");
        }

		if (file_exists($upload_path)) 
        {
			unlink($upload_path);
		}
        move_uploaded_file($file["tmp_name"], $upload_path);    
    }
    
}
