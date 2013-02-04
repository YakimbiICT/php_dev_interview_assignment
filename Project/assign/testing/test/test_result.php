<?php
require_once('../simpletest/autorun.php');

require_once('../classes/api.php');

include_once '../../lib/DB/DB.php';
include '../../lib/Flicker/flicker.php';
include '../../lib/Google/google.php';
include '../../lib/goole_flicker.php';
include '../../lib/favourite.php';


class TestOfLogging extends UnitTestCase {
	
    function __construct() {
        parent::__construct('Api test');
    }
	
    function testAPIServiceIsEmpty() {
      $obj_gofick = new Google_Flicker();
      
      $images = $obj_gofick->getImages(array('name'=>'puppy','search'=>'f'));	

      $this->assertTrue($images);
    }
}
?>

<a href="#" onclick="window.history.back()">Back</a>
