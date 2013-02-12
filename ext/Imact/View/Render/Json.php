<?php
namespace Imact\View\Render;

use \HttpResponse;

class Json extends Base
{

    private $methodMap = array("add" => array("POST"), "edit" => array("POST"),
            "random" => array("GET"), "read" => array("GET", "HEAD"),
            "delete" => array("DELETE"));

    private $contentMap = array("add" => array("required" => array("id")),
            "edit" => array("required" => array("id"),
                    "param" => array("description", "title")),
            "read" => array("param" => array("id")), "random" => array(),
            "delete" => array("param" => array("id")));

    public function __construct($template = "main.phtml", $mask = "json")
    {

        $this->inErr = false;
        HttpResponse::setContentType('application/json');
        HttpResponse::setCache(true);
        HttpResponse::setGzip(true);

        // Always a successful response
        // Error responses are inline to json data
       HttpResponse::status(200);
        $this->status = 200;

        //Checks and assigns data for request
        $this->init();
    }

    private function init()
    {

        //Note: Only using imgur hence only id input
        //Retrieve then save to favorites
        $action = self::$input['action'];
        $id = self::$input['id'];

        //Make sure request is not in error
        if (!$this->validMethod($action) || !$this->validContent($action)) {
            $this->inErr = true;
            $this->assignData("err", $action);
        }

    }

    public function output()
    {

        //Make sure request is not in error
        if (!$this->inErr) {
            $action = self::$input['action'];
            $this->assignData("data", $action);
        }

        HttpResponse::setData(json_encode($this->data));

    }

    public function render(){
    	HttpResponse::send();
    }

    private function validMethod($action)
    {

        if (empty($action)
                || !in_array(self::$method, $this->methodMap[$action])) {
            $this->status = 400;
            return false;
        }

        return true;

    }

    private function validContent($action)
    {

        foreach ($this->contentMap[$action] as $type => $params) {
            $must = $type == "required";
            foreach ($params as $name) {

                //All required parameters must be set
                @$varStor = self::$input[$name];
                @$varStor2 = self::$input['data'][$name];
                $exist = !empty($varStor) || !empty($varStor2);

                if ($must && !$exist) {
                    $this->status = 400;
                    return false;
                }

                //At least one param must be set for edit
                if (!$must && $exist) {
                    $oneParamSet = true;
                }

            }
        }

        if (isset($contentMap[$action]['param']) && !$oneParamSet) {
            $this->status = 400;
            return false;
        }

        return true;

    }

    private function invalidContentMsg($action)
    {

        $method = implode('/', $this->methodMap[$action]);
        $msg = 'You must you the "' . $method . '" method for the "' . $action
                . '" action' . "\n";

        $msg .= "Required parameters are: ";
        foreach ($this->contentMap[$action]['required'] as $key => $param) {
            $msg .= $param;
            if (count($this->contentMap[$action]['required']) != ($key + 1))
                $msg .= ",";
        }

        $msg .= "\n";

        $msg .= "Coupled with a single parameter from the following list: ";
        foreach ($this->contentMap[$action]['param'] as $key => $param) {
            $msg .= $param;
            if (count($this->contentMap[$action]['required']) != ($key + 1))
                $msg .= ",";
        }

        $msg .= "\n";
        return $msg;

    }

    private function assignData($type, $action)
    {

        $response = array();

        switch ($type) {
        case "err":
            $response['error']['message'] = $this->invalidContentMsg($action);
            $response['success'] = false;
            break;
        case "data":
            if (isset($this->data))
                $response = array_merge($this->data, $response);
            break;
        }

        if (empty($response['status']))
            $response['status'] = $this->status;

        $this->data = $response;
    }

}
