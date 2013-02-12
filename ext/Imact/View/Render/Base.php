<?php
namespace Imact\View\Render;

use Imact\View\Base as Core;

abstract class Base extends Core
{

    public $data;

    public function content()
    {

        foreach ($this->templates["tpl"] as $tpl) {
            include $tpl;
        }

    }

    public function pushTpl($filename)
    {
        $this->templates["tpl"][] = $filename;
    }

    public function popTpl($filename = "")
    {

        if (!empty($filename)) {
            $key = array_search($filename, $this->templates["tpl"]);
            unset($this->templates["tpl"][$key]);
        } else {
            array_pop($this->templates["tpl"]);
        }
    }

}
