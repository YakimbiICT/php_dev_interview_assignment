<?php
class Flicker_Service{
	
	
	private $key = '46dea5f6abb12aed7a823adb7ecf5816';
	private $keyword;
	private $images = array();
	
	function __construct(){}
	
	
	
	public function setParam($keyword)
	{
		$this->keyword = $keyword;
		return $this;
	}
	
	
	public function getFlickerImages()
	{
		
		$search = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='.$this->key.'&tags='.$this->keyword.'&per_page=20&format=php_serial';
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $search);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		$result = unserialize($result); 
		
		if($result && !empty($result)){
			foreach($result['photos']['photo'] as $photo) { 	
			$this->images[] = array('t'=>'f',
			's' => '"' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '_s.jpg"',
			'i'=>'<img src="' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '_s.jpg">');   
			}
		}	

		return $this->images;
			
	}
}
?>