<?php

/**
 * This is autoload file of the Image component.
 * Autoload file helps to load all the classes of the current component.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */

$_dir   = dirname(__FILE__) . '/';
$_files = array('Image.php',
                'SimpleImage.php');

foreach ($_files as $file)
    require_once $_dir . $file;

unset($_dir, $_files);