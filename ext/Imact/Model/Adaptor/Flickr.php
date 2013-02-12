<?php
namespace Imact\Model\Adaptor;

use phpFlickr\phpFlickr;

//Used to make the Imgur API calls
//Their servers are basically your remote DBs with a filtration layer
class Flickr extends Base
{

    private $base = "https://api.imgur.com/3/";
    private $credentials;

    //In this case it will only be images
    public function __construct($location = "gallery/hot/viral/")
    {

        $this->credentials = array("key" => 'b1936ff5d74276d01e20ff64fc5fd256',
        		                   "secret" => "99e3ffcdc58c36af", );
        $this->init();
    }

    private function init()
    {
        self::$resource['flickr'] = new phpFlickr($this->credentials['key']);

    }

    public function gallery($id)
    {

            $data = self::$resource['flickr']->favorites_getList(NULL,NULL,NULL,NULL,NULL,20,$id);
            print_r($data);
            die;

        return $data;
    }

}
