<?php

require_once(PROJECT_ROOT_PATH . '/src/exceptions/ClientErrorException.class.php');

class NotAcceptableException extends ClientErrorException 
{
    protected $RESPONSE_CODE = 406;
    public function __contruct($message="Unsupported content-type!")
    {
        parent::__construct($message);
    }
}