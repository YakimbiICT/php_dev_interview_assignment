<?php
namespace Dan\Yakimbi\Service;

use Guzzle\Http\Client as GuzzleClient;

use Doctrine\Common\Cache\FilesystemCache;
use Guzzle\Cache\DoctrineCacheAdapter;
use Guzzle\Cache\NullCacheAdapter;
use Guzzle\Plugin\Cache\CachePlugin;

class FlickrService {
    
    private $guzzleClient;
    
    public function __construct(GuzzleClient $guzzleClient) {
        $this->guzzleClient = $guzzleClient;
        
        $adapter = new DoctrineCacheAdapter(new FilesystemCache(__DIR__.'/../../../../cache'));
//        $adapter = new NullCacheAdapter();
        $cache = new CachePlugin($adapter, true);

        $this->guzzleClient->addSubscriber($cache);
    }
    
    public function getRandomImages($num=20)
    {
        $data = $this->sendRequest(array(
            'method' => 'flickr.photos.getRecent',
            'per_page' => 1000,
            'page' => 1,
        ));

        $photos = $data->photos->photo;
        shuffle($photos);
        $photos = array_slice($photos, 0, $num);
        
        foreach($photos as $i => $photo) {
            $url = 'http://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}_m.jpg';
            $photos[$i]->url = strtr($url, array(
                '{farm-id}' => $photo->farm,
                '{server-id}' => $photo->server,
                '{id}' => $photo->id,
                '{secret}' => $photo->secret,
            ));
            $pageUrl = 'http://www.flickr.com/photos/{owner}/{id}/';
            $photos[$i]->pageUrl = strtr($pageUrl, array(
                '{owner}' => $photo->owner,
                '{id}' => $photo->id,
            ));
        }
        
        return $photos;
    }
    
    private function sendRequest($parameters)
    {
        $request = $this->guzzleClient->get('?'. http_build_query($parameters));
        $request->getParams()->set('cache.override_ttl', 300);
        $response = $request->send();
        $body = $response->getBody();
        $body = preg_replace('/^jsonFlickrApi\(/','', $body);
        $body = preg_replace('/\)$/','', $body);
        return json_decode($body);
    }
}