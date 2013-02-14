<?php
namespace Dan\Yakimbi;

use Guzzle\Http\Client as GuzzleClient;

class Application
{
    private $route;
    private $guzzleClient;
    
    public function __construct($route = null)
    {
        $this->rootDir = __DIR__.'/../../..';
        $this->setRoute($route);
    }
    
    public function setRoute($route)
    {
        if ($route == '' || is_null($route)) {
            $route = '/';
        }
            
        $this->route = $route;
    }
    
    public function run()
    {
        if ($this->route=='/') {
            return $this->homeAction();
        }
        
        if (preg_match('/^\/image\/(?P<id>\w+)[\/]?$/',$this->route, $matches)) {
            return $this->imageAction($matches['id']);
        }

        if (preg_match('/^\/favorites[\/]?$/',$this->route, $matches)) {
            return $this->favoritesAction();
        }
        
        return $this->notFoundAction();
    }
    
    public function setGuzzleClient(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }
    private function getGuzzleClient()
    {
        if ($this->guzzleClient) {
        
            return $this->guzzleClient;
        }
        $api_key = 'af61ea011bda41aabe9617ba4af884f4';
        $guzzleClient = new GuzzleClient(
                'http://api.flickr.com/services/rest?api_key='.$api_key.'&format=json'
            );
        
        return $guzzleClient;
    }
    
    public function homeAction()
    {
        
        
        $loader = new \Twig_Loader_Filesystem($this->rootDir.'/views/');
        $twig = new \Twig_Environment($loader, array());
        
        
        $guzzleClient = $this->getGuzzleClient();
        $flickr = new Service\FlickrService($guzzleClient);
        $images = $flickr->getRandomImages(20);

        return $twig->render('home.html.twig', array('images' => $images));
    }
    
    public function imageAction($id)
    {
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $imageMan = new Model\ImageManager();
            $store = new Model\Store('/data', 'images.yml', 'id');
            $imageMan->setStore($store);
            
            $image = $imageMan->find($id);
            try {
                $image->bind(json_decode(file_get_contents("php://input")));
                $imageMan->save($image);
                
                return json_encode($image->toArray());
            } catch (\Exception $e) {
                header('HTTP/1.0 400 Bad Request');
            }
        }
    }

    public function favoritesAction()
    {
        $imageMan = new Model\ImageManager();
        $store = new Model\Store('/data', 'images.yml', 'id');
        $imageMan->setStore($store);

        $images = $imageMan->getAll();
        
        $loader = new \Twig_Loader_Filesystem($this->rootDir.'/views/');
        $twig = new \Twig_Environment($loader, array());

        return $twig->render('favorites.html.twig', array('images' => $images));
    }
    
    public function notFoundAction() {
        header('HTTP/1.0 404 Not Found');
        return 'Not Found';
    }
}