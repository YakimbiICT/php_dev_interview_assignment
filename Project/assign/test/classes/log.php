<?php

class Log {
    
    var $path;
        
    function __construct($path) {
        $this->path = $path;
    }
        
    function message($message) {
        $file = fopen($this->path, 'a');
        fwrite($file, $message . "\n");
        fclose($file);
    }
}

?>
