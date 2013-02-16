<?php

/**
 * Simple Image. Implements basic functions of the image interface.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class SimpleImage implements Image {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * The image id.
     * @var string
     */
    private $id;

    /**
     * The image url.
     * @var string
     */
    private $url;

    /**
     * The image name.
     * @var string
     */
    private $name;

    /**
     * The image description.
     * @var string
     */
    private $description;

    /**
     * Indicates if image is favorite or not.
     * @var boolean
     */
    private $isFavorite;

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * @param $id - id of the image
     * @param $url - image's url
     * @param $name - image's name
     */
    function __construct($id, $url, $name) {
        $this->id   = $id;
        $this->url  = $url;
        $this->name = $name;
    }

    // -----------------------------------------------
    // Overridden methods (from Image)
    // -----------------------------------------------

    public function getId() {
        return $this->id;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setFavorite($is) {
        $this->isFavorite = $is;
    }

    public function removeDescription() {
        $this->description = "";
    }

    public function toArray() {
        return array(   'id'	        => $this->getId(),
                        'url'	        => $this->getUrl(),
                        'name'	        => $this->getId(),
                        'description'   => $this->getDescription()
                    );
    }

    public function isFavorite() {
        return $this->isFavorite;
    }

}