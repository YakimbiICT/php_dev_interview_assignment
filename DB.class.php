<?php
require 'config.php';
class DB {
    
    private $db;

    function __construct() {
        
    }

    /**
     * getInstance - create db connection
     *
     * @access public
     * @param  none
     * @return object
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function getInstance() {
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
        try {
            $db = new PDO($dsn,DB_USER,DB_PASSWORD);
            return $db;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }
    }
}
?>
