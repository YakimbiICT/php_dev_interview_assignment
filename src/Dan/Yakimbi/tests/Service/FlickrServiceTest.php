<?php

namespace Dan\Yakimbi\Tests\Service;
use Dan\Yakimbi\Service\FlickrService;
use Dan\Yakimbi\Test\GuzzleClient;

class FlickrServiceTest extends \PHPUnit_Framework_TestCase
{
    
    public function testHome()
    {
        $guzzleClient = new GuzzleClient();
        $service = new FlickrService($guzzleClient);
        
        $photos = $service->getRandomImages(5);
        
        $this->assertCount(5, $photos);
        $this->assertTrue(is_array($photos));
        $this->assertInstanceOf('\stdClass', $photos[0]);
        
    }

}