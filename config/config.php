<?php
require_once realpath(__DIR__ . '/../vendor/autoload.php');
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
echo getenv("DB_HOST");