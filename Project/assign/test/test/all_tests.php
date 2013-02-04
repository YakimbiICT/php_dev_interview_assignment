<?php
require_once( '../simpletest/autorun.php');
require_once('log_test.php');
require_once('clock_test.php');

class AllTests extends TestSuite {
    function AllTests() {
        parent::__construct();
        $this->addFile('log_test.php');
        $this->addFile('clock_test.php');
    }
}
?>