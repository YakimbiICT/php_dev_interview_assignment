<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

$route = isset($_GET['r'])?$_GET['r']:null;
$app = new Dan\Yakimbi\Application($route);

echo $app->run();