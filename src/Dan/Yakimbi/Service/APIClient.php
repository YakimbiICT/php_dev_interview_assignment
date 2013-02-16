<?php
namespace Dan\Yakimbi\Service;

use Guzzle\Http\Client as GuzzleClient;

class APIClient
{
    
    public function __construct(GuzzleClient $guzzleClient = null)
    {
        if (!$guzzleClient) {
            $guzzleClient = new GuzzleClient();
        }
        
        $config = new Config();

        $guzzleClient->setBaseUrl('http://yakimbi/api/v1/');
        
        $this->guzzleClient = $guzzleClient;        
    }
    
    public function getRandomImages()
    {
        $request = $this->guzzleClient->get('random_images');
        
        $response = $request->send();
        $headers = $response->getHeaders();
        if ($response->isSuccessful()) {
            try {
                return json_decode($response->getBody());
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'ERROR';
        }
    }    
    
    public function setFavorite($id, $url, $description = null)
    {
        $favorite = array(
            'id' => $id,
            'url' => $url,
            'description' => $description,
        );
        $request = $this->guzzleClient->put('favorites/'.$id, null, json_encode($favorite));
        
        $response = $request->send();
        if ($response->isSuccessful()) {
            try {
                return json_decode($response->getBody());
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'ERROR';
        }
    }
    
    public function removeFavorite($id)
    {
        $request = $this->guzzleClient->delete('favorites/'.$id);
        
        $response = $request->send();
        if ($response->isSuccessful()) {
            try {
                return json_decode($response->getBody());
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'ERROR';
        }
    }    
    
    public function getFavorites()
    {
        $request = $this->guzzleClient->get('favorites');
        
        $response = $request->send();
        if ($response->isSuccessful()) {
            try {
                return json_decode($response->getBody());
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'ERROR';
        }
    }    
}