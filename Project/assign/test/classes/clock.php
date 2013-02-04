<?php
class Clock {
     private $offset = 0;
    
    function now() {
        return time() + $this->offset;
    }
    
    function advance($offset) {
        $this->offset += $offset;
    }
}
?>