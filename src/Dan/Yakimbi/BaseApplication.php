<?php

namespace Dan\Yakimbi;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseApplication
{
    private $request;
    private $rootDir;
    private $config;
    
    public function __construct()
    {
        $this->rootDir = __DIR__.'/../../..';
        $this->config = new Service\Config();
    }

    protected function getRequest()
    {
        return $this->request;
    }
    
    protected function getRouteDir()
    {
        return $this->rootDir;
    }
    
    protected function getConfig()
    {
        return $this->config;
    }
    
    public function run(Request $request = null)
    {
        if (null === $request) {
            $request = Request::createFromGlobals();
        }
        $this->request = $request;
        
        $response = $this->getResponse();
        $response->send();
    }
    
    protected function getResponse()
    {        
        throw new \Exception('You must to implement Application::getResponse()');
    }
    
    public function render($template, $data)
    {
        $loader = new \Twig_Loader_Filesystem($this->rootDir.'/views/');
        $twig = new \Twig_Environment($loader, array());

        return new Response(
            $twig->render($template, $data)
        );
    }
    
    public function notFoundAction()
    {
       return new Response('Resource not found', 404);
    }
    
}