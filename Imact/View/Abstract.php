<?php


abstract class Imact_View_Abstract extends Imact_Base {

	protected $templates, $mask, $location ,$render;

	//Setup a simple natviation environment
	public function __construct($template="main.phtml", $mask="html"){

		$this->templates['main'] = ucfirst($template);
		$this->location = self::$basedir."Imact/Imact/View/Theme/";
		$this->mask= $mask;

		//Ensure universal content wrapper is present for view type
		if(!file_exists($this->location.ucfirst($this->mask)."/".$this->templates['main'])){
			//throw Imact_Controller_Exception("There is no matching main template for ".$this->$mask." .");
		}

	}

	public function output(){

		require $this->location.ucfirst($this->mask)."/".$this->templates['main'];

	}


}