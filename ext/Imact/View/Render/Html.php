<?php
namespace Imact\View\Render;

class Html extends Base
{

    public function __construct($template = "main.phtml", $mask = "html")
    {
        ob_start();
        parent::__construct($template, $mask);
    }

    public function render(){
        while (@ob_end_flush());
    }

}
