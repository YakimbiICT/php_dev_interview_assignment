<?php

namespace Tests;
use Dan\Yakimbi\Application;

class HomeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testHomeRoutes()
    {
        $app = new Application('/');
        $output = $app->run();
        $this->assertRegExp('/it\'s works/', $output);
        
        $app = new Application('');
        $output = $app->run();
        $this->assertRegExp('/it\'s works/', $output);
        
        $app = new Application();
        $output = $app->run();
        $this->assertRegExp('/it\'s works/', $output);
    }

}