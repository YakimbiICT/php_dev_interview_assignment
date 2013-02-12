<?php
namespace Imact;

abstract class Base
{

    //Used to interact with the appropriate storage system
    static protected $err, $method, $input, $controller;

    //Just a hardcoded static config
    static protected $dbServer = array("user" => "root", "password" => "lodrum", "host" => "localhost", "db" => "imact");

    static protected $basedir = "/srv/http/";
    static protected $basePath = "http://127.0.0.1/Imact/http/";
    static protected $baseTrim = "Imact/http/";

    protected function log($type, $msg)
    {
        $this->err[$type][__CLASS__] = $msg;
    }

}
