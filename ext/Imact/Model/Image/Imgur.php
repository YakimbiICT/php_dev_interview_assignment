<?php
namespace Imact\Model\Image;

use Imact\Model\Image\Base as Core;
use Imact\Model\Adaptor\Imgur as ImgurAdaptor;

class Imgur extends Core
{

    private $api, $diff;

    public function __construct($adaptor = "Imact\\Model\\Adaptor\\Mysql",
            $location = array())
    {
        parent::__construct($adaptor, $location);

        $this->data['service'] = "imgur_rest_v3";
        $this->diff = array("datetime", "animated", "views", "bandwidth",
                "deletehash", "link", "vote", "account_url", "bandwidth",
                "ups", "downs", "score", "is_album");
        $this->api = new ImgurAdaptor();

    }

    /**
     * Return the metadata for an image ID on imgur
     * @param int $id The imgur id with which to grab and save data.
     */
    public function create($id, $isFav = false)
    {

        $existing = $this->readFavorites($id);
        if (empty($existing)) {
            $coreData = $this->read($id);

            if (!empty($coreData)) {
                //Strip out and serialize the extra API metadata specifics
                //which do not need a mapping
                $diff = array_flip($this->diff);
                $custom = array_intersect_key($coreData, $diff);
                $coreData = array_diff_key($coreData, $diff);

                $coreData['specifics'] = serialize($custom);
                if ($isFav)
                    $coreData['favorite'] = 1;

                $params = array("command" => "insert", "data" => $coreData);
                $sql = $this->query($params);
                return $this->store->exec($sql);
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    /**
     * Return the metadata for an image ID on imgur
     * @param int $id
     */
    public function read($id)
    {
        $data = $this->api->read($id);

        if ($data['success']) {
            return $data['data'];
        } else {
            //Append the error to runtime log
            $this->log("Error", $data['data']['error']['message']);

            return false;
        }
    }

    /**
     * Return the metadata for gallery of images on imgur for random selection
     * @param int $id
     */
    public function readGallery($id)
    {
        $data = $this->api->gallery($id);

        if ($data['success']) {
            return $data['data'];
        } else {
            //Append the error to runtime log
            $this->log("Error", $data['data']['error']['message']);

            return false;
        }
    }

    public function readRandomSet()
    {

        $id = rand(1, 3);
        $data = $this->readGallery($id);

        $num = count($data);

        $selection = array();
        foreach (range(1, 20, 1) as $value) {
            $index = (rand(1, $value * 10)) % $num;
            $this->rollAgain($data, $index, $selection, array($value, $num));
            $selection[$index] = null;
        }

        $data = array_intersect_key($data, $selection);

        return $data;
    }

    //Only need to read on favorites so lets hardcode for the moment
    public function readFavorites($id = "")
    {
        $params = array("command" => "select",
                "where" => array("favorite" => 1,));

        //For returning a single set of data
        if (!empty($id)) {
            $params['where']["id"] = $id;
        }

        $sql = $this->query($params);
        $data = $this->store->read($sql);

        //$oData = array();
        foreach ($data as &$row) {
            $this->map($row, true);
            //Unserialize all the diff variables not normally used in search
            if (!empty($row['specifics'])) {
                $extra_metadata = unserialize($row['specifics']);
                if (is_array($extra_metadata))
                    $row = array_merge($row, $extra_metadata);
                unset($row['specifics']);
                //$oData = self::factory($row);
            }
        }

        return $data;
    }

    private function rollAgain(&$dat, &$ind, &$selection, $details)
    {

        static $attempts = 0;

        //If the image is too long, find something more concise
        if (array_key_exists($ind, $selection) || $dat[$ind]['is_album']
                || $dat[$ind]['height'] > 1000) {
            $ind = (rand(1, $details[0] * 10)) % $details[1];
            //if($attempts < 40){
            $this->rollAgain($dat, $ind, $selection, $details);
            $attempts++;
            //}else{
            //	$attempts = 0;
            //}
        }
    }
}
