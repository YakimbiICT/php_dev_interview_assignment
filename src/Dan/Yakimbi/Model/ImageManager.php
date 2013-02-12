<?php

namespace Dan\Yakimbi\Model;

class ImageManager
{
    const BASE_PATH = '/../../../..';
    
    private $store;
    
    public function setStore($store) {
        $this->store = $store;
    }
    
    public function getAll()
    {
        
        $data = $this->store->getData();
        $images = array();
        foreach ($data as $i => $item) {
            $image = new Image($item);
            
            $images[] = $image;
        }
        
        return $images;
    }
    
    public function find($id) {
        if (!($data = $this->store->getEntityData($id))) {
            $data = array('id' => $id);
        }
        
        return new Image($data);
    }
    
    public function save(Image $image) {
        
        $this->store->setEntityData($image->toArray());
    }
    
    public function remove(Image $image) {
        
        $this->store->unsetEntityData($image->toArray());
    }
    
}