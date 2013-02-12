<?php

namespace Dan\Yakimbi\Model;

class Image
{
    private $id;
    private $isFavorite;
    private $url;
    private $description;
    
    public function __construct($data=null) {
        if ($data) {
            if (isset($data['id'])) {
                $this->setId($data['id']);
            }
            if (isset($data['isFavorite'])) {
                $this->setIsFavorite($data['isFavorite']);
            }
            if (isset($data['url'])) {
                $this->setUrl($data['url']);
            }
            if (isset($data['description'])) {
                $this->setDescription($data['description']);
            }
        }
    }
    
    public function setId($id)
    {
        $this->id = trim($id);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setIsFavorite($isFavorite)
    {
        $this->isFavorite = $isFavorite;
    }
    
    public function isFavorite()
    {
        return $this->isFavorite;
    }
    
    public function setUrl($url)
    {
        $this->url = trim($url);
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function toArray()
    {
        return array(
          'id' => $this->getId(),
          'isFavorite' => $this->isFavorite(),
          'url' => $this->getUrl(),
          'description' => $this->getDescription(),
        );
    }
}