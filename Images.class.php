<?php

class Images {

    private $db;

    function __construct() {
        $database = new DB();
        $this->db = $database->getInstance();
    }

    /**
     * getRandomImages - get random images from Flickr API
     *
     * @access public
     * @param  string $api_key,string $tag
     * @return array
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function getRandomImages($api_key = NULL, $tag = NULL, $count = 20) {
        if (!$api_key || !$tag) {
            return FALSE;
        } else {
            $rand = rand(0, 200);
            $url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $api_key . '&tags=' . $tag . '&content_type=json&format=json&nojsoncallback=1&per_page=' . $count . '&page=' . $rand;
            $ch = curl_init();

            // Requesting images from Flickr as JSON string
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            $k = json_decode(curl_exec($ch));
            curl_close($ch);
            if (isset($k) && $k->stat == 'ok') {
                return $k->photos->photo;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * getUserImages - get images for user
     *
     * @access public
     * @param  int $user_id
     * @return array
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function getUserImages($user_id = NULL) {
        $query = $this->db->prepare('SELECT * FROM images WHERE user = ? AND status=? ORDER BY id DESC');
        $query->execute(array($user_id,1));
        $res = $query->fetchAll();
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    
    /**
     * addImage - add Image to DB
     *
     * @access public
     * @param  int $user_id, String $title, String $url, String $thumb, String $description   
     * @return int - last inserted id
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function addImage($user_id,$title,$url,$thumb,$description) {
        $query = $this->db->prepare('INSERT INTO `images` (user,image_title,image_url,image_thumb_url,image_description,status,created,updated) VALUES (?,?,?,?,?,?,?,?)');
        $res = $query->execute(array($user_id, $title, $url, $thumb, $description, 1, time(), time()));
        if ($res) {
            return $this->db->lastInsertId();
        } else {
            return FALSE;
        }
    }
    
    /**
     * removeImage - Update image status as 0
     *
     * @access public
     * @param  int $id
     * @return bool
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function removeImage($id) {
        $query = $this->db->prepare('UPDATE `images` SET status=? WHERE id=?');
        $res = $query->execute(array(0,$id));
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * updateDescription - Update image description
     *
     * @access public
     * @param  int $id, String $description
     * @return bool
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function updateDescription($id,$description) {
        $query = $this->db->prepare('UPDATE `images` SET image_description=? WHERE id=?');
        $res = $query->execute(array($description,$id));
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>
