<?php
require_once('../classes/clock.php');

class TestOfClock extends UnitTestCase {
    function testClockTellsTime() {
        $clock = new Clock();
        $this->assertEqual($clock->now(), time());
    }
}
?>