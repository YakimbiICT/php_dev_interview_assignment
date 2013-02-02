<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

class DB {

    private static $instance;
    private $link;
    
    /**
     *  Init and connect Database
     * @param array $config
     * @return boolean
     * @throws Exception
     */
    private function __construct($config) {
        $this->link = @mysql_connect($config['host'], $config['username'], $config['password']);
        if (!$this->link) {
            throw new Exception("db connect error");
        }

        if (!mysql_select_db($config['name'])) {
            throw new Exception("invalid db name");
        }

        return true;
    }

    /**
     *  Database instance
     * @param array $config
     * @return DB
     */
    public static function instance($config) {
        if (!self::$instance) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     *  Database Query
     *  
     * @param string $sql
     * @return resource 
     * @throws Exception
     */
    public function query($sql) {
        $qr = mysql_query($sql, $this->link);
        if (!$qr) {
            throw new Exception(mysql_error());
        }
        return $qr;
    }

    /**
     * Fetch query result set
     * 
     * @param resource $qr
     * @return array
     */
    public function fetch($qr) {
        return mysql_fetch_assoc($qr);
    }

    /**
     * Fetch all query result set 
     * 
     * @param resource $qr
     * @return array
     */
    
    public function fetch_all($qr) {
        $arr = array();
        while ($data = $this->fetch($qr)) {
            $arr[] = $data;
        }
        return $arr;
    }

    /*
     * Get last inserted ID
     * @return int
     */
    public function inserted_id(){
        return mysql_insert_id($this->link);
        }
      
     /**
      * Escape String
      * 
      * @param string $var
      * @return string
      */
    public function escape($var){
        return mysql_real_escape_string($var);
        }
}

?>
