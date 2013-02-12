<?php
namespace Imact\Controller;

use Imact\Base as Core;

abstract class Base extends Core
{

	public $view;
    protected $model;

    public function __construct()
    {
        $viewClass = "Imact\\View\\Render\\".ucfirst(self::$input['format']);
        $this->view = new $viewClass();

        $modelClass = "Imact\\Model\\".$this->model;
        $this->model = new $modelClass();
    }

    abstract public function failsafe();


    public function output(){
    	$this->view->output();

    }

    public function render(){
    	$this->view->render();
    }
}
