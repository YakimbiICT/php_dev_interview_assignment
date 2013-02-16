<?php

/**
 * This is autoload file of the ExternalService component.
 * Autoload file helps to load all the classes of the current component.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */

$_dir   = dirname(__FILE__) . '/';
$_files = array('ServiceMetadata.php',
                'ServiceMetadataImpl.php',
                'ExternalService.php',
                'FlikrService.php',
                'InstagramService.php',
                'ExternalServiceFactory.php');

foreach ($_files as $file)
    require_once $_dir . $file;

unset($_dir, $_files);