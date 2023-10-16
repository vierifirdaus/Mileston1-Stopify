<?php
require_once(PROJECT_ROOT_PATH . '/src/exceptions/ClientErrorException.class.php');

class BadRequestException extends ClientErrorException 
{
    protected $RESPONSE_CODE = 400;
    public function __contruct($message="Bad Request!")
    {
        parent::__construct($message);
    }
}