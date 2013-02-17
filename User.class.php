<?php

class User {

    private $db;

    function __construct() {
        $database = new DB();
        $this->db = $database->getInstance();
    }

    /**
     * getUser - check if user exists if not create user
     *
     * @access public
     * @param  none
     * @return int - user_id
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function getUser() {
        if(isset($_COOKIE['phptest_user']) && $_COOKIE['phptest_user']!=''){
            $user_id = $this->getUserInfo($_COOKIE['phptest_user']);
            if(!$user_id){
                $auth_val = md5(time().rand(0,100));
                $user_arr = array('auth_value'=>$auth_val,
                            'last_accessed_on'=>time(),
                            'last_access_ip'=>$_SERVER['REMOTE_ADDR']);
                $add_user = $this->createUser($user_arr);
                $_SESSION['user_id']=$add_user;
                $_SESSION['auth_key']=$auth_val;
                setcookie('phptest_user',$auth_val,time()+(3600*365));
                return $add_user;
            }else{
                $user_arr = array('last_accessed_on'=>time(),
                            'last_access_ip'=>$_SERVER['REMOTE_ADDR']);
                $update_user = $this->updateUser($user_arr, $user_id);
                $_SESSION['user_id']=$user_id;
                $_SESSION['auth_key']=$_COOKIE['phptest_user'];
                setcookie('phptest_user',$_COOKIE['phptest_user'],time()+(3600*365));
                return $update_user;
            }
        }else{
            $auth_val = md5(time().rand(0,100));
            $user_arr = array('auth_value'=>$auth_val,
                        'last_accessed_on'=>time(),
                        'last_access_ip'=>$_SERVER['REMOTE_ADDR']);
            $add_user = $this->createUser($user_arr);
            $_SESSION['user_id']=$add_user;
            $_SESSION['auth_key']=$auth_val;
            setcookie('phptest_user',$auth_val,time()+(3600*365));
            return $add_user;
        }
    }
    
    
    /**
     * getUserInfo - get user infomation based on authenticating key
     *
     * @access public
     * @param  string $auth_val
     * @return array
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function getUserInfo($auth_val){
        $query = $this->db->prepare('SELECT id FROM user WHERE auth_value = ?');
        $query->execute(array($auth_val));
        $res = $query->fetchColumn();
        if($res){
            return $res;
        }  else {
            return false;
        }
    }
    
    /**
     * createUser - create new user
     *
     * @access public
     * @param  array $user_info
     * @return int - last inserted id
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function createUser($user_info){
        $query = $this->db->prepare('INSERT INTO `user` (auth_value,last_accessed_on,last_access_ip) VALUES (?,?,?)');
        $res = $query->execute(array($user_info['auth_value'],$user_info['last_accessed_on'],$user_info['last_access_ip']));
        if($res){
            return $this->db->lastInsertId();
        }  else {
            return false;
        }
    }
    
    
    /**
     * updateUser - update user
     *
     * @access public
     * @param  array $user_info, int $id
     * @return int - user id
     * @author Pubudu - pubudusj@gmail.com
     * 
     * */
    public function updateUser($user_info,$id){
        $query = $this->db->prepare('UPDATE `user` SET last_accessed_on=?,last_access_ip=? WHERE id=?');
        $res = $query->execute(array($user_info['last_accessed_on'],$user_info['last_access_ip'],$id));
        if($res){
            return $id;
        }  else {
            return FALSE;
        }
    }
}
?>
