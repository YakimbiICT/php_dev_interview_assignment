<?php

class Imact_View_Render_Html extends Imact_View_Render_Abstract {


	public function __construct($template="main.phtml", $mask="html"){
			ob_start();
			parent::__construct($template, $mask);
	}

	public function __destruct(){
			$this->output();
			while (@ob_end_flush());
	}

}