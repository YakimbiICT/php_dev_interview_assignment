<?php

namespace Tests;
use Dan\Yakimbi\Application;
use Dan\Yakimbi\Test\GuzzleClient;

class HomeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testHomeRoutes()
    {
        $guzzleClient = new GuzzleClient();
        
        $imgPattern = '/<img src="(\w|\/|:|{|}|.)*" \/>/';
        
        $app = new Application('/');
        $app->setGuzzleClient($guzzleClient);
        $output = $app->run();
        $this->assertRegExp($imgPattern, $output);
        $this->assertEquals(20, preg_match_all($imgPattern, $output, $matches));
        
        $app = new Application('');
        $app->setGuzzleClient($guzzleClient);
        $output = $app->run();
        $this->assertRegExp($imgPattern, $output);
        
        $app = new Application();
        $app->setGuzzleClient($guzzleClient);
        $output = $app->run();
        $this->assertRegExp($imgPattern, $output);
    }

}