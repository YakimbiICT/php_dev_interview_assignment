<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

require("./config.php");

/** 
 * Register Auto Loader
 */
spl_autoload_register('autoloadClass');

function autoloadClass($name, $ext = 'php') {
    $file =  "./includes/class_" . strtolower($name) . "." . $ext;
    if (file_exists($file)) {
        require($file);
    } else {
        die("Class \"$name\" does not exist !");
    }
}


/**
 * init App Class
 */

$app = app::instance($config);


?>