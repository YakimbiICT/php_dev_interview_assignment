<?php
namespace Dan\Yakimbi;

use Dan\Yakimbi\Service\FlickrService;
use Guzzle\Http\Client as GuzzleClient;

class Application
{
    private $route;
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
    }
    
    public function homeAction()
    {
        $loader = new \Twig_Loader_Filesystem($this->rootDir.'/views/');
        $twig = new \Twig_Environment($loader, array());
        
        $api_key = 'af61ea011bda41aabe9617ba4af884f4';
        $guzzleClient = new GuzzleClient('http://api.flickr.com/services/rest?api_key='.$api_key.'&format=json');
        $flickrService = new FlickrService($guzzleClient);
        
        return $twig->render('home.html.twig', array());
    }
}