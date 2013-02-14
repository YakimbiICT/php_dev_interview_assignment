<?php

namespace Dan\Yakimbi\Model;

use Symfony\Component\Yaml\Yaml;

class Store
{
    const BASE_PATH = '/../../../..';
    
    private $path;
    private $filename;
    private $idKey;
    
    public function __construct($path, $filename, $idKey)
    {
        $this->path = $path;
        $this->filename = $filename;
        $this->idKey = $idKey;
    }
    
    public function clear()
    {
        @unlink($this->getAbsFilename());
    }


    private function getAbsFilename()
    {
        return __DIR__.self::BASE_PATH.$this->path.'/'.$this->filename;
    }
    
    public function getEntityData($id) {
        $data = $this->getData();
        if (isset($data[$id])) {
            return $data[$id];
        }
        return null;
    }
    
    public function setEntityData($entityData) {
        $data = $this->getData();
        $data[$entityData[$this->idKey]] = $entityData;
        $this->setData($data);
    }
    
    public function unsetEntityData($entityData) {
        $data = $this->getData();
        unset($data[$entityData[$this->idKey]]);
        $this->setData($data);
    }
    
    public function getData() {
        $dataFile = $this->getAbsFilename();
        if (file_exists($dataFile)) {
            $data = Yaml::parse(file_get_contents($dataFile));
        }
        
        if (!$data) {
            $data = array();
        }
        
        return $data;
    }
    
    public function setData($data) {
        $dataFile = $this->getAbsFilename();
        file_put_contents($dataFile, Yaml::dump($data, 9));
    }
    
}
