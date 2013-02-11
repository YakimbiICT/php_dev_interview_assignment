<?php
namespace Dan\Yakimbi;

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
        
        return $twig->render('home.html.twig', array());
    }
}