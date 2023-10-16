<?php 
require_once __DIR__ . "/../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . "/src/router/PageRouter.class.php";
session_start();
$page=new pageRouter($_SERVER['REQUEST_URI']);
$page->getPage();
// run php -S localhost:8000 