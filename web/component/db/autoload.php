<?php

/**
 * This is autoload file of the Database component.
 * Autoload file helps to load all the classes of the current component.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */

$_dir   = dirname(__FILE__) . '/';
$_files = array('Database.php',
                'MysqlDatabase.php',
                'SimpleTable.php');

foreach ($_files as $file)
    require_once $_dir . $file;

unset($_dir, $_files);