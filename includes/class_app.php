<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

class app {
    
    private static $instance;
    private $db;

    /**
     * init App 
     * @param array $config
     */
    private function __construct($config) {
        try {
            $this->db = DB::instance($config['db']);
        } catch (Exception $e) {
            die("Error : " . $e->getMessage());
        }
    }

    /** 
     * Instance
     * @param array $config
     * @return App
     */
       public static function instance($config = array()) {
        if (!self::$instance) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }
    
    
    /**
     * Add image to favorite
     * @param array $data Image Data
     * @return int record ID
     */
    public function add_favorite($data) {

        $this->db->query("insert into fav (thumb_url,img_url,description) 
           values ('"
                . $this->db->escape($data['thumb'])
                . "','" . $this->db->escape($data['url'])
                . "','" . $this->db->escape($data['description'])
                . "')");

        return $this->db->inserted_id();
    }

    /**
     * Delete Image from Favorite
     * @param int $id Image ID
     * @return boolean
     */
    public function del_favorite($id) {
        $id = (int) $id;
        $this->db->query("delete from fav where id='" . $id . "'");
        return true;
    }

    /**
     *  Edit Favorite Image
     * @param array $data Image Data
     * @return boolean
     */
    public function edit_favorite($data) {
        $this->db->query("update fav set description='" . $this->db->escape($data['description']) . "' where id='" . intval($data['id']) . "'");
        return true;
    }

    /**
     * Get favorite images
     * @return array
     */
    public function get_favorites() {

        $qr = $this->db->query("select * from fav order by id desc");
        $rows = $this->db->fetch_all($qr);
        return $rows;
    }

}

?>
