<?php
namespace Imact\Test\Controller;

use Imact\Test\Base as Core;
use Imact\Controller\Favorite;

class FavoriteTest extends Core
{

	protected $model, $view;

    public function __construct()
    {
    	self::$input['format'] = 'html'; // Required for setup but not required for this portion of the test
    	self::$controller = new Favorite();

        parent::__construct();

    }

    /**
     * Checking that the data is set by the controller
     */
    public function read()
    {

    	sleep(1);
    	self::$input['id'] = '6EBSIGa';

    	self::$controller->read();

    	$ref = self::$controller;

    	$json = '{"0":{"localKey":"68","type":"image\/jpeg","width":"669",'
    			.'"height":"1000","size":"218699","title":"THIS HAS BEEN EDIT'
    			.' TESTED API CALL","description":"","id":"6EBSIGa","favorite"'
    			.':"1","service":null,"datetime":1359859351,"animated":false,'
    			.'"views":1138824,"bandwidth":249059669976,"vote":null,'
    			.'"account_url":null,"link":"http:\/\/i.imgur.com\/6EBSIGa.jpg",'
    			.'"ups":3553,"downs":192,"score":4283,"is_album":false},"status":200}';

    	$dataSample = json_decode($json, true);

    	$this->equals(self::$controller->view->data, $dataSample);

    }

}
