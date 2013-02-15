<?php

namespace Tests;
use Dan\Yakimbi\Application;
use Dan\Yakimbi\Test\GuzzleClient;
use Symfony\Component\HttpFoundation\Request;

class HomeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testHomeRoutes()
    {
        $guzzleClient = new GuzzleClient();
        
        $imgPattern = '/<img src="(\w|\/|:|{|}|.)*" \/>/';
        
        $app = new Application();
        $app->setGuzzleClient($guzzleClient);
        ob_start();
            $app->run(Request::create('/'));
            $output = ob_get_contents();
        ob_end_clean();
        $this->assertRegExp($imgPattern, $output);
        $this->assertEquals(20, preg_match_all($imgPattern, $output, $matches));
    }

}