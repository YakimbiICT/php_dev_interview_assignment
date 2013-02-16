<?php
namespace Dan\Yakimbi\Test;

use Guzzle\Http\Client as BaseGuzzleClient;
use Guzzle\Http\Message\Request as BaseRequest;
use Guzzle\Http\Message\Response as BaseResponse;

class GuzzleClient extends BaseGuzzleClient
{
    public function __construct()
    {
        
    }
    
    public function setBaseUrl($url) {
        return $this;
    }
    
    public function get($uri = null, $headers = null, $body = null)
    {
        return new Request();
    }
      
}

class Request extends BaseRequest
{
    public function __construct()
    {
        
    }
    
    public function send()
    {
        return new Response();
    }
    
    public function getParams()
    {
        return new Params();
    }
    
}

class Response extends BaseResponse
{
    public function __construct()
    {
        
    }
    
    public function getBody()
    {
        $data = new \stdClass();
        $data->photos = new \stdClass();
        $data->photos->photo = array();
        for ($i=0; $i<30; $i++) {
            $photo = new \stdClass();
            $photo->farm = '{my-farm-id}';
            $photo->server = '{my-server-id}';
            $photo->id = '{my-id}';
            $photo->secret = '{my-secret}';
            $photo->owner = '{my-owner}';
            $data->photos->photo[$i] = $photo;
        }
        $data = 'jsonFlickrApi('.json_encode($data).')';
        return $data;
    }
    
}

class Params
{
    public function set($key, $value) {
        
    }
}