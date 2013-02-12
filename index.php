<?php
require_once "./ext/Fig/SplClassLoader.php";
require_once "./ext/Imact/Loader.php";

Imact\Loader::init();
$app = new Imact\App();
