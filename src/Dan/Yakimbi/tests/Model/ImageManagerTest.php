<?php

namespace Dan\Yakimbi\Tests\Model;
use Dan\Yakimbi\Model\ImageManager;
use Dan\Yakimbi\Model\Store;

class ImageManaterTest extends \PHPUnit_Framework_TestCase
{
    
    public function test()
    {
        $imageMan = new ImageManager();
        $store = new Store('/cache', 'images.yml', 'id');
        $store->clear();
        $imageMan->setStore($store);

        $image = $imageMan->find('[id]');
        
        $this->assertInstanceOf('\Dan\Yakimbi\Model\Image', $image);
        $this->assertEquals('[id]', $image->getId());
        $this->assertNull($image->getUrl());
        $this->assertNull($image->isFavorite());
        $this->assertNull($image->getDescription());
        
        $image->setUrl('[url]');
        $image->setIsFavorite(true);
        $imageMan->save($image);
        
        $image = $imageMan->find('[id]');

        $this->assertInstanceOf('\Dan\Yakimbi\Model\Image', $image);
        $this->assertEquals('[id]', $image->getId());
        $this->assertEquals('[url]', $image->getUrl());
        $this->assertTrue($image->isFavorite());
        $this->assertNull($image->getDescription());
        
        $imageMan->remove($image);
        
        $image = $imageMan->find('[id]');
        
        $this->assertInstanceOf('\Dan\Yakimbi\Model\Image', $image);
        $this->assertEquals('[id]', $image->getId());
        $this->assertNull($image->getUrl());
        $this->assertNull($image->isFavorite());
        $this->assertNull($image->getDescription());
    }

}