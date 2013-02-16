<?php

namespace Dan\Yakimbi\Service;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private $data;
    
    public function __construct($file=null)
    {
        if (!$file) {
            $file = __DIR__.'/../../../../config/config.yml';
        }
        $this->data = Yaml::parse(file_get_contents($file));
    }
    
    public function get($path)
    {
        $path = explode('.', $path);
        $data = $this->data;
        try {
            foreach ($path as $part) {
                $data = $data[$part];
            }
        } catch (\Exception $e) {
            throw new \Exception('Configuration key not found');
        }
        
        return $data;
    }
}