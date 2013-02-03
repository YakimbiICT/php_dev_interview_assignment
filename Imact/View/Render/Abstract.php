<?php

abstract class Imact_View_Render_Abstract extends Imact_View_Abstract {

	public $data;

	public function content(){

		foreach($this->templates["tpl"] as $tpl){
			include $tpl;
		}

	}

	public function pushTpl($filename){
		$this->templates["tpl"][] = $filename;
	}

	public function popTpl($filename=""){

		if(!empty($filename)){
		$key = array_search($filename, $this->templates["tpl"]);
		unset($this->templates["tpl"][$key]);
		}else{
			array_pop($this->templates["tpl"]);
		}
	}

}