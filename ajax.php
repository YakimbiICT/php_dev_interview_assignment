<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

require("./global.php");

$action = $_REQUEST['action'];

try {
    $ajax = new ajax();
    print $ajax->get($action);
} catch (Exception $e) {
    die($e->getMessage());
}
?>
