<?php

/**
 * Controls actions and behavior of the image hosting service and its components.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ImageHostingController {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * Concrete external service provides access to the external image services.
     *
     * @var ExternalService
     */
    private $service;

    /**
     * Service factory helps to create specific external service.
     *
     * @var ExternalServiceFactory
     */
    private $serviceFactory;

    /**
     * Database used to store image data.
     *
     * @var Database
     */
    private $database;

    /**
     * Image table used to manage table with image data.
     *
     * @var ImageTable
     */
    private $imageTable;

    /**
     * User with its own session.
     *
     * @var User
     */
    private $user;

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * @param $dbServer - mysql server address
     * @param $dbUsername - mysql server username
     * @param $dbPassword - mysql server password
     * @param $dbName - database name used to store image hosting service data
     */
    public function __construct($dbServer, $dbUsername, $dbPassword, $dbName) {
        $this->serviceFactory   = ExternalServiceFactory::getInstance();
        $this->database         = new MysqlDatabase($dbServer, $dbUsername, $dbPassword, $dbName);
        $this->imageTable       = new ImageTable($this->database);
        $this->user             = new User();
    }

    // -----------------------------------------------
    // Public methods
    // -----------------------------------------------

    /**
     * Outputs all previously generated images, except favorite images.
     */
    public function showGeneratedImages() {
        $list = $this->imageTable->getListByUser($this->user->getName());
        $this->printImageTable($list);
    }

    /**
     * Shows images that were tagged as "favorite" images.
     */
    public function showFavoriteImages() {
        $list = $this->imageTable->getFavoriteList($this->user->getName());
        $this->printImageTable($list);
    }

    /**
     * Generates images from specific service.
     *
     * @param $serviceName - service images from will be generated
     */
    public function generateImages($serviceName) {

        $this->removeNonFavoriteImages();

        if ($serviceName == 'flikr') {
            $this->service = $this->serviceFactory->createFlikrService();
        } else if ($serviceName == 'instagram') {
            $this->service = $this->serviceFactory->createInstagramService();
        }

        $images     = $this->service->loadMetadata();
        $dbImages   = array();

        foreach ($images as $image) {
            $i = new ImageDO(   $this->imageTable,
                                $image->getId(),
                                $image->getUrl(),
                                $image->getName(),
                                $this->user->getName());
            $i->setDescription("");
            $dbImages[] = $i->toArray();
        }

        $this->printImages($dbImages);
    }

    /**
     * Sets image with specific id as favorite.
     *
     * @param $id - id of the image in the database
     */
    public function addFavoriteImage($id) {
        $this->imageTable->updateFavorite($id, true);
    }

    /**
     * Removes favorite status of the image.
     *
     * @param $id - id of the image in the database
     */
    public function removeFavoriteImage($id) {
        $this->imageTable->delete($id);
        //$this->imageTable->updateFavorite($id, false);
    }

    /**
     * Sets the description of the image.
     *
     * @param $id - id of the image in the database
     * @param $description - new image description
     */
    public function setImageDescription($id, $description) {
        $this->imageTable->updateDescription($id, $description);
    }

    /**
     * Removes image's description.
     *
     * @param $id - id of the image in the database
     */
    public function removeImageDescription($id) {
        $this->imageTable->updateDescription($id, "");
    }

    /**
     * Removes all generated images (including favorite) of the current user.
     */
    public function removeImages() {
        $this->imageTable->deleteByUser($this->user->getName());
    }

    // -----------------------------------------------
    // Private methods
    // -----------------------------------------------

    /**
     * Removes all random images (non favorite) of the current user.
     */
    private function removeNonFavoriteImages() {
        $this->imageTable->deleteWithFavoriteStatus($this->user->getName(), false);
    }

    /**
     * Outputs image list that has been retrieved from the images table.
     *
     * @param $list
     */
    private function printImageTable($list) {

        if ($list == null || count($list) == 0)
            return;


        $images = array();
        foreach ($list as $row) {
            $i = new SimpleImage(   $row[ImageTable::FIELD_ID],
                                    $row[ImageTable::FIELD_URL],
                                    $row[ImageTable::FIELD_NAME]);
            $i->setDescription($row[ImageTable::FIELD_DESCRIPTION]);
            $i->setFavorite($row[ImageTable::FIELD_FAVORITE]);
            $images[] = $i->toArray();
        }

        $this->printImages($images);
    }

    /**
     * Prints the array to the output stream in json format.
     *
     * @param array $images
     */
    private function printImages(array $images) {
        if ($images != null && count($images) > 0)
            echo json_encode($images);
    }

}