<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem(__DIR__.'/../views/');
$twig = new \Twig_Environment($loader, array(
));

if (!isset($_GET['r']) || !$_GET['r']) {
    echo $twig->render('home.html.twig', array());
}


