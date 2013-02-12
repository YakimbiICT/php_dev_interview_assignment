<?php
namespace Imact\View;

use Imact\Base as Core;

abstract class Base extends Core
{

    protected $templates, $mask, $location, $render;

    //Setup a simple natviation environment
    public function __construct($template = "main.phtml", $mask = "html")
    {

        $this->templates['main'] = ucfirst($template);
        $this->location = self::$basedir . "Imact/ext/Imact/View/Theme/";
        $this->mask = $mask;

        //Ensure universal content wrapper is present for view type
        if (!file_exists(
                $this->location . ucfirst($this->mask) . "/"
                        . $this->templates['main'])) {
            //throw Imact_Controller_Exception("There is no matching main template for ".$this->$mask." .");
        }

    }

    public function output()
    {

        require $this->location . ucfirst($this->mask) . "/"
                . $this->templates['main'];

    }

}
