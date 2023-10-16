<?php
require_once(PROJECT_ROOT_PATH . '/src/exceptions/ClientErrorException.class.php');
class ForbiddenException extends ClientErrorException 
{
    protected $RESPONSE_CODE = 403;
    public function __contruct($message="You dont have access to this resource!")
    {
        parent::__construct($message);
    }
}