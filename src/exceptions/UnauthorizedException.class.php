<?php
require_once(PROJECT_ROOT_PATH . '/src/exceptions/ClientErrorException.class.php');
class UnauthorizedException extends ClientErrorException 
{
    protected $RESPONSE_CODE = 401;
    public function __contruct($message="You have to login first!")
    {
        parent::__construct($message);
    }
}