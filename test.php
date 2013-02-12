<?php

use Imact\Test as App;

require_once "../ext/Fig/SplClassLoader.php";
require_once "../ext/Imact/Loader.php";

Imact\Loader::init();
$app = new App(array('Imact\\Model\\Adaptor\\Imgur',
		                    'Imact\\Controller\\Favorite',
		                    'Imact\\View\\Render\\Json'));
