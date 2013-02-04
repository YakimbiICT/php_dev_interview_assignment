<?php

class Google_Flicker{
	
	
	private $api;
	private $keyword;
	private $google_service;
    private $fliker_service;
    
	private $images = array();
	
	function __construct()
	{
		$this->fliker_service = new Flicker_Service();
		$this->google_service = new Google_Services();
	}
	
	private function processRequest($data)
	{
		$this->api = (isset($data['search']))? trim($data['search']): 'g' ;
		$this->keyword = trim($data['name']);
		
		return $this;
	}
	
	public function getImages($data)
	{
		$this->processRequest($data);
		
		switch ($this->api){
			case 'g':
				$this->images = $this->google_service->setParam($this->keyword)
							->get_images();
				break;
			case 'f':
				
				$this->images = $this->fliker_service->setParam($this->keyword)
							->getFlickerImages();
				break;
				
			default :
				break;
		}
		
		return $this->images;
	}
	
	
	
	

    
   
}
?>