<?php


class Imact_Loader {

	static public function autoload($class) {
		$depth = str_replace('_', '/', $class);
		$path = "../".$depth.".php";
		include $path;
	}

}

spl_autoload_register(function ($class) {
	Imact_Loader::autoload($class);
});
