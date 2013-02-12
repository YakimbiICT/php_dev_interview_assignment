<?php
namespace Imact;

use Fig\SplClassLoader as SplLoader;

class Loader
{

    static public function init()
    {
        $loader = new SplLoader("Imact", "./ext");
        $loader->register();
    }

}
