<?php

require_once ('../simpletest/autorun.php');
require_once('../classes/log.php');

class TestOfLogging extends UnitTestCase {
    
    
    function __construct() {
        parent::__construct('Log test');
    }
    
    function setUp() {
        @unlink('../temp/test.log');
    }

    function tearDown() {
        @unlink('../temp/test.log');
    }
    
    function getFileLine($filename, $index) {
        $messages = file($filename);
        return $messages[$index];
    }
    
    function testCreatingNewFile() {
        $log = new Log('../temp/test.log');
        $this->assertFalse(file_exists('../temp/test.log'), 'Created before message');
        $log->message('Should write this to a file');
        $this->assertTrue(file_exists('../temp/test.log'), 'File created');
    }
    
    function testSecondMessageIsAppended() {
        $log = new Log('../temp/test.log');
        $log->message('Test line 1');
        $this->assertPattern('/Test line 1/', $this->getFileLine('../temp/test.log', 0));
        $log->message('Test line 2');
        $this->assertPattern('/Test line 2/', $this->getFileLine('../temp/test.log', 1));
    }
}

?>

