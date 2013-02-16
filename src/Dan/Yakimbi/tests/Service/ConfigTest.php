<?php

namespace Dan\Yakimbi\Tests\Service;
use Dan\Yakimbi\Service\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    
    public function testGet()
    {
        $config = new Config(__DIR__.'/../fixtures/config.yml');
        $this->assertEquals('value', $config->get('root.parent.child'));
    }
    
    public function testThrowsExceptionKeyNotExists()
    {
        try {
            $config = new Config(__DIR__.'/../fixtures/config.yml');
            $this->assertEquals('value', $config->get('not_existing_key.parent.child'));
        } catch (\Exception $e) {
            $this->assertContains('Configuration key not found', $e->getMessage());

            return;
        }
        $this->fail();
    }
}