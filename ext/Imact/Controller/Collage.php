<?php
namespace Imact\Controller;


class Collage extends Base
{

    public function __construct()
    {
        $this->model = "Image\\Imgur";
        parent::__construct();
        $this->view
                ->pushTpl(
                        self::$basedir
                                . "Imact/ext/Imact/View/Tpl/Html/Collage/ImageGrid.phtml");
        //$this->view->pushJs("../assets/js/script.js");

    }

    public function failsafe()
    {
        $this->random();
    }

    public function random()
    {
        $this->view->enableFav = false;
        $this->view->data = $this->model->readRandomSet();
    }

}
