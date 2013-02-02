<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

require("./global.php");

$action = $_REQUEST['action'];

try {
    $api = new api();
    print $api->get($action);
} catch (Exception $e) {
    die($e->getMessage());
}
?>
