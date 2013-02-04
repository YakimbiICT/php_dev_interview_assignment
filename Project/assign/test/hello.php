<?php

require_once(dirname(__FILE__) . '/simpletest/autorun.php');

include 'classes/log.php';

class TestOfLogging extends UnitTestCase {
    function testFirstLogMessagesCreatesFileIfNonexistent() {
        
        @unlink(dirname(__FILE__) . '/temp/test.log');
        $log = new Log(dirname(__FILE__) . '/temp/test.log');
        $log->message('Should write this to a file');
        $this->assertTrue(file_exists(dirname(__FILE__) . '/temp/test.log'));
        
    }
}

?>

