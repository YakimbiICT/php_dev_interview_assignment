<?php


abstract class Imact_Controller_Base extends Imact_Base {

	protected $view, $model;

	public function __construct(){
		$viewClass = "Imact_View_Render_".ucfirst(self::$input['format']) ;
		$this->view = new $viewClass();

		$modelClass = "Imact_Model_".$this->model;
		$this->model = new $modelClass();
	}

	abstract public function failsafe();

}