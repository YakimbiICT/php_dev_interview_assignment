<?php

/**
 * Simple implementation of the ServiceMetadata interface.
 * Holds all the metadata values.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ServiceMetadataImpl implements ServiceMetadata {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * Image's id.
     *
     * @var String
     */
    private $id;

    /**
     * Image's url.
     *
     * @var String
     */
    private $url;

    /**
     * Image's name.
     *
     * @var String
     */
    private $name;

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * @param $id - id of the image
     * @param $url - url of the image
     * @param $name - image's name
     */
    function __construct($id, $url, $name) {
        $this->id   = $id;
        $this->url  = $url;
        $this->name = $name;
    }

    // -----------------------------------------------
    // Getter methods
    // -----------------------------------------------

    function getId() {
        return $this->id;
    }

    function getUrl() {
        return $this->url;
    }

    function getName() {
        return $this->name;
    }

}