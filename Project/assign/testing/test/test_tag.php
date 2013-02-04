<?php
require_once('../simpletest/autorun.php');

require_once('../classes/api.php');



class TestOfLogging extends UnitTestCase {
	
    function __construct() {
        parent::__construct('Api test');
    }
	
    function testAPIServiceIsEmpty() {
      
        $api = new API();
        $this->assertFalse(null);

        $this->assertTrue('puppy');
    }
}
?>

<a href="#" onclick="window.history.back()">Back</a>
