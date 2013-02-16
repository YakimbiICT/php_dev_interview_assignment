<?php
namespace Dan\Yakimbi;

use Guzzle\Http\Client as GuzzleClient;
use Symfony\Component\HttpFoundation\Response;

class Application extends BaseApplication
{
    private $guzzleClient;
    
    public function setGuzzleClient(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }
    
    private function getGuzzleClient()
    {
        if (!$this->guzzleClient) {
            $this->guzzleClient = new GuzzleClient();
        }
        
        return $this->guzzleClient;
    }
    
    protected function getResponse()
    {
        $request = $this->getRequest();
        $route = $request->getRequestUri();
        
        if ($route=='/') {
            return $this->homeAction();
        }
        
        if (preg_match('/^\/favorites[\/]?$/',$route, $matches)) {
            return $this->favoritesAction();
        }
        if (preg_match('/^\/api_client_test[\/]?$/',$route)) {
            return $this->apiClientTestAction();
        }
        
        if (preg_match('/^\/api\/v1\/random_images[\/]?$/',$route)) {
            return $this->apiRandomImagesAction();
        }
        
        if (preg_match('/^\/api\/v1\/favorites[\/]?$/',$route)) {
            return $this->apiFavoritesAction();
        }
        
        if (preg_match('/^\/api\/v1\/favorites\/(?P<id>\w+)[\/]?$/',$route, $matches)) {
            return $this->apiFavoriteAction($matches['id']);
        }
        
        return $this->notFoundAction();
    }
    
    public function homeAction()
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'GET') {
            return new Response('Method not allowed', 405);
        }
        
        $flickr = new Service\FlickrService($this->getGuzzleClient());
        $images = $flickr->getRandomImages(20);

        return $this->render('home.html.twig', array(
            'route' => 'home',
            'images' => $images
        ));
    }
    
    public function favoritesAction()
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'GET') {
            return new Response('Method not allowed', 405);
        }
        
        $imageMan = new Model\ImageManager();
        $store = new Model\Store('/data', 'images.yml', 'id');
        $imageMan->setStore($store);

        $images = $imageMan->getAll();
        
        return $this->render('favorites.html.twig', array(
            'route' => 'favorites',
            'images' => $images
        ));
    }
    
    public function apiClientTestAction()
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'GET') {
            return new Response('Method not allowed', 405);
        }
        
        $client = new Service\APIClient();
//        return new Response(var_dump($client->getRandomImages()));
//        return new Response(var_dump($client->setFavorite('8478239175','http://farm9.staticflickr.com/8383/8478239175_52ddd49a21_m.jpg', 'asdfasdf')));
//        return new Response(var_dump($client->setFavorite('8478239175','http://farm9.staticflickr.com/8383/8478239175_52ddd49a21_m.jpg')));
        return new Response(var_dump($client->getFavorites()));
    }
    
    public function apiRandomImagesAction()
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'GET') {
            return new Response('Method not allowed', 405);
        }
        $flickr = new Service\FlickrService($this->getGuzzleClient());
        $images = $flickr->getRandomImages(20);

        return new Response(json_encode($images));
        
    }

    public function apiFavoriteAction($id=null)
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'POST') {
            return new Response('Method not allowed', 405);
        }
        $imageMan = new Model\ImageManager();
        $store = new Model\Store('/data', 'images.yml', 'id');
        $imageMan->setStore($store);

        $image = $imageMan->find($id);
        try {
            $image->bind(json_decode(file_get_contents("php://input")));
            $imageMan->save($image);

            return new Response(json_encode($image->toArray()));
        } catch (\Exception $e) {
            return new Response('Bad request', 400);
        }
    }

    
    
    public function apiFavoritesAction()
    {
        $request = $this->getRequest();
        
        if ($request->getMethod() != 'GET') {
            return new Response('Method not allowed', 405);
        }

        $imageMan = new Model\ImageManager();
        $store = new Model\Store('/data', 'images.yml', 'id');
        $imageMan->setStore($store);

        $images = $imageMan->getAll();
        
        foreach($images as $i => $image) {
            $images[$i] = $image->toArray();
        }
        
        return new Response(json_encode($images));
    }
}