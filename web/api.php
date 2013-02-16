<?php
/**
 * Provides api calls to the image hosting service module.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */

require_once 'component/db/autoload.php';
require_once 'component/service/autoload.php';
require_once 'component/image/autoload.php';
require_once 'component/user/autoload.php';
require_once 'module/imagehosting/ImageHostingController.php';
require_once 'module/imagehosting/ImageDO.php';
require_once 'module/imagehosting/ImageTable.php';
require_once 'config.php';

// initialize api controller
$controller = new ImageHostingController(   DATABASE_SERVER,
                                            DATABASE_USER,
                                            DATABASE_PASSWORD,
                                            DATABASE_NAME);

// control variables
$mod    = isset($_GET['mod'])   ? $_GET['mod']   : '';
$act    = isset($_GET['act'])   ? $_GET['act']   : '';
$seact  = isset($_GET['seact']) ? $_GET['seact'] : '';
$id     = isset($_GET['id'])    ? $_GET['id'] : '';

// route api calls
if ($mod == 'flikr') {
    $controller->generateImages('flikr');

} else if ($mod == 'instagram') {
    $controller->generateImages('instagram');

} else if ($mod == 'favorite' && $act == 'add' && !empty($id)) {
    $controller->addFavoriteImage($id);

} else if ($mod == 'favorite' && $act == 'remove' && !empty($id)) {
    $controller->removeFavoriteImage($id);

} else if ($mod == 'favorite' && $act == 'description' && $seact == 'add' && !empty($id)) {
    file_put_contents("a.txt", $_SERVER['QUERY_STRING'] . implode($_POST, ""));
    $controller->setImageDescription($id, $_REQUEST['text']);

} else if ($mod == 'favorite' && $act == 'description' && $seact == 'remove' && !empty($id)) {
    $controller->removeImageDescription($id);

} else if ($mod == 'favorite' && empty($id)) {
    $controller->showFavoriteImages();

} else if (empty($mod)) {
    $controller->showGeneratedImages();

}