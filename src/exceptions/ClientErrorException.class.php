<?php
abstract class ClientErrorException extends Exception
{
    protected $RESPONSE_CODE;

    public function __construct($message="")
    {
        parent::__construct($message);
    }

    public function getResponseCode()
    {
        return static::$RESPONSE_CODE;
    }
}
