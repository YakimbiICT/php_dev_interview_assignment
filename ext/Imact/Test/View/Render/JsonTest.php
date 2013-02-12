<?php

namespace Imact\Test\View\Render;

use Imact\Test\Base as Core;
use Imact\Controller\Favorite;
use \HttpResponse;


class JsonTest extends Core
{


	public function __construct()
	{
		self::$input['format'] = 'json';
		self::$controller = new Favorite();
		parent::__construct();

	}

	public function outputTest($expected){

		sleep(1);
		self::$input['id'] = '6EBSIGa';
		self::$controller->read();
		self::$controller->output();

		$ref = self::$controller;

		$json = '{"localKey":"47",
    	      "type":"image\/jpeg",
    	      "width":"1024",
    	      "height":"768",
    	      "size":"127422",
    	      "title":"I think the FBI is parked outside my apartment.",
    	      "description":"Monitoring grand master flash and his furious five",
    	      "id":"sfAL6MN","favorite":"1","service":null,"datetime":1359576991,
    	      "animated":false,"views":1484637,"bandwidth":189175415814,"vote":null,
    	      "account_url":null,"link":"http:\/\/i.imgur.com\/sfAL6MN.jpg",
    	      "ups":3074,"downs":19,"score":4180,"is_album":false}';

		$output = trim(HttpResponse::getData());
		$this->equals($output, $json);
	}
}
