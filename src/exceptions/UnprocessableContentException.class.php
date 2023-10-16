<?php
include_once(PROJECT_ROOT_PATH . '/src/exceptions/ClientErrorException.class.php');

class UnprocessableContentException extends ClientErrorException 
{
    protected $RESPONSE_CODE = 422;
    public function __contruct($message="Content unproccessable!")
    {
        parent::__construct($message);
    }
}