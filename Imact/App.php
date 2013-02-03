<?php


/**
 * Encapsulating app for module business logic
 * @author Edward
 *
 */
class Imact_App extends Imact_Base {

	private $noneHaveMatched = true;

	public function __construct(){

		//error_reporting(E_ERROR);
		self::$method = $_SERVER['REQUEST_METHOD'];

		//Boostrap address and inputs
		$this->parseUri();

		//Boostrap inputs
		if(self::$input['format'] == "json"){
			parse_str(rawurldecode(HttpResponse::getRequestBody()), self::$input['data']);
		}else if(self::$input['format'] == "html"){
			self::$input['data']= $_REQUEST;
		}

		//Clean the tainted input to meet global spec
		$this->clean();


		//Hand off to controller
		$class = "Imact_Controller_".self::$input['controller'];
		$action = self::$input['action'];

		self::$controller = new $class();
		self::$controller->$action();
	}



	private function parseUri(){

		$controllers= array("collage", "favorite");

		$context = str_replace(self::$baseTrim, "", $_SERVER['REQUEST_URI']);
		$portions = explode( '/' , $context );


		if(empty($portions[1])
			|| !in_array($portions[1], $controllers)
			|| count($portions)< 3)
		{
			self::$err[]= "Please use the form http://imact.lagnus.info/collage/{action}/{id}";

			self::$input['controller'] = "Collage";
			self::$input['action'] = "random";
		}else{

			self::$input['controller'] = ucfirst($portions[1]);
			self::$input['action'] = $portions[2];
			if(isset($portions[3])){
				self::$input['id'] = $portions[3];
			}
		}

		$this->setFormat();

	}

	private function setFormat(){;

		$formats = array("html" => array("text/html", "application/xhtml+xml"),"json" => array("application/json", "text/javascript"));
		$headers = HttpResponse::getRequestHeaders();

		$types = $headers['Accept'];
		$types = explode(',', $types);

		foreach($formats as $output=>$mime){
			foreach($mime as $type){
				if(in_array($type, $types)){
					self::$input['format'] = $output;
					break;
				}
			}
		}

		if(self::$input['format'] == null){
			self::$input['format'] = "html";
		}
	}

	private function clean(){
		$this->sweep(self::$input);
	}

	private function sweep(&$arr){
		foreach($arr as &$taint){
			if(is_array($taint)):
			$this->sweep($taint);
			else:
			$this->filter($taint);
			endif;
		}
	}

	//Apply all global filtration to inputs here
	private function filter(&$value){
		$value = strip_tags($value);
	}
}