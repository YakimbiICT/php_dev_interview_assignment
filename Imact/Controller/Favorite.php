<?php


class Imact_Controller_Favorite extends Imact_Controller_Base{

	public function __construct(){
		$this->model = "Image_Imgur";
		parent::__construct();
		$this->view->pushTpl(self::$basedir."Imact/View/Tpl/Html/Collage/ImageGrid.phtml");
		//$this->view->pushJs("../assets/js/script.js");

	}

	public function failsafe(){
		$this->read();
	}

	public function read(){
		$this->view->enableFav = true;
		$this->view->data = $this->model->readFavorites();
	}

	public function __call($name, $arguments){
		$allowed = array("add", "edit", "delete");

		if( self::$input['format'] == "json" &&
			in_array($name, $allowed) ){

			$this->$name();
		}else{
			$this->failsafe();
		}
	}

	public function add(){
		$this->edit(true);
	}

	private function edit($create=false){

		$mData = array();

		if($create){
			$result = $this->model->create(self::$input['id'],true);
		}else{
			$existing = $this->model->readFavorites(self::$input['id']);
			if(!empty($existing)){
				$data['description'] = self::$input['data']['description'];

				//Commented out ot allow implicit deletion of description
				//if(empty($data['description'])) unset($data['description']);

				$data['title'] = self::$input['data']['title'];
				
				// Commented out to allow inplicit deletion of title
				//if(empty($data['title'])) unset($data['title']);

				if(!empty($data)){
					$this->model->data = $data;
					$result = $this->model->edit(self::$input['id']);
				}else{
					$result=false;
				}
			}else{
				$mData['status'] = 404;
				$result=false;
			}
		}

		$msg = ($create ? "add favorite" : "edit favorite");

		if(!$result){

			$mData['error']['message'] = " Failed to ".$msg;
			$mData['success'] = false;
			if(!isset($mData['status']))$mData['status'] = 400;
		}else{
			$mData['success'] = true;
			$mData['status'] = 200;
		}

		$this->view->data = $mData;
	}

	private function delete(){

		$mData = array();
		if(!$this->model->delete(self::$input['id'])){
			$mData['error']['message'] = " Failed to delete favorite";
			$mData['success'] = false;
			$mData['status'] = 400;
		}else{
			$mData['success'] = true;
			$mData['status'] = 200;
		}
		$this->view->data = $mData;
	}
}
