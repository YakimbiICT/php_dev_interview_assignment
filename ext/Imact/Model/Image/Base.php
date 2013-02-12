<?php
namespace Imact\Model\Image;

use Imact\Model\Base as Core;

abstract class Base extends Core
{
    /*
        public $data = array(
                                    "localPrimaryKey" => "null",
                                    "type"=> null,
                                    "width" => null,
                                    "height" => null,
                                    "size" => null,
                                    "title" => null,
                                    "description" => null,
                                    "id" => null,
                                    "favorite" => null,
                                    "service" => null,
                                    "specifics" => null,
                                  );

     */

    public $data = array();

    protected $dMap = array("localKey" => "id", "type" => "type",
            "width" => "width", "height" => "height", "size" => "size",
            "title" => "title", "description" => "description",
            "id" => "api_resource_id", "favorite" => "favorite",
            "service" => "api", "specifics" => "custom_data",);

    //Something not predictably images
    protected $table = "imact_images";

    public function edit($id)
    {

        $params = array("command" => "update", "data" => $this->data,
                "where" => array('id' => $id));
        $sql = $this->query($params);
        $result = $this->store->exec($sql);
        return ($result > -1 && is_numeric($result) ? true : false);
    }

    public function delete($id)
    {

        $existing = $this->readFavorites($id);
        if (!empty($existing)) {
            $params = array("command" => "delete",
                    "where" => array('id' => $id));
            $sql = $this->query($params);
            return $this->store->exec($sql);
        } else {
            return true;
        }
    }

}
