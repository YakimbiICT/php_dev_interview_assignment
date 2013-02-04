<?php

class Rest_Service {
	
	private $rest_request;
	private $google_service;
    private $fliker_service;
    private $data ;
	function __construct()
	{
		
		$this->rest_request = new RestRequest();
		$this->fliker_service = new Flicker_Service();
		$this->google_service = new Google_Services();
	}
	
	function processVars()
	{
		$rest_data = RestUtils::processRequest();
		$request_vars = $rest_data->getRequestVars();
		
		switch ($request_vars['service']) {
			case 'search':
			$data = $this->getImages($request_vars['engine'],$request_vars['tag'],$request_vars['datatype']);
			break;
			case '':
				break;
			default:
				;
			break;
		}
		return $data;
	}
	
	public function getImages($en,$tag,$datatype)
	{
		if(!empty($en) && !empty($tag) && $en == 'g'){
			return $this->getGoogle($tag, $datatype);
		}else{
			return $this->getFlicker($tag, $datatype);
		}
	}
	
	function getGoogle($tag,$datatype)
	{
		
		$data = $this->google_service->setParam($tag)->get_images();
		$i=0;
		if($datatype == 'json'){
			foreach($data as $d){
				$i++;
				$src = str_replace('"', '', html_entity_decode($d['s']));
				$img[$i] = array('image'=>$src,'engine'=>'google');
			}
			$result =array('d'=> json_encode($img),'c'=>'text/html');
		}else{
			
			$result = array('d'=> $this->getXml($data, 'google'),'c'=>'text/xml');
		}
		
		return  $result;
	}
	
	
	function getFlicker($tag,$datatype)
	{
		$data = $this->fliker_service->setParam($tag)->getFlickerImages();
		$i=0;
		if($datatype == 'json'){
			foreach($data as $d){
				$i++;
				$src = str_replace('"', '', html_entity_decode($d['s']));
				$img[$i] = array('image'=>$src,'engine'=>'flicker');
			}
			$result = array('d'=> json_encode($img),'c'=>'text/html');
		}else{
			
			$result = array('d'=> $this->getXml($data, 'flicker'),'c'=>'text/xml');
		}
		
		return  $result;
	}
	
	
	function getXml($data,$type)
	{
		$h = '';
		$h .= '<?xml version="1.0" encoding="UTF-8"?>';
		$h .= '<feed>';
		foreach($data as $d){
			$src = str_replace('"', '', html_entity_decode($d['s']));
			$h .='<item>';
				$h .= '<src>'.$src.'</src>';
				$h .= '<engine>'.$type.'</engine>';
			
			$h .='</item>';
		}
		$h .='</feed>';
		
		return $h;
	}
}
?>