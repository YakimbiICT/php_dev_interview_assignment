<?php

/**
 * Image implementation integrated with database and image table.
 * "DO" postfix means Data Object.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ImageDO extends SimpleImage implements Image {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * Image table used to manage table with image data.
     *
     * @var ImageTable
     */
    private $imageTable;

    /**
     * Image's user.
     *
     * @var string
     */
    private $user;

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * @param ImageTable $imageTable - ImageTable object used to perform operations with image table
     * @param $id - id of the image
     * @param $url - image's url
     * @param $name - image's name
     * @param string|null $user - image's user
     */
    public function __construct(ImageTable $imageTable, $id, $url, $name, $user = null) {
        parent::__construct($id, $url, $name);
        $this->imageTable   = $imageTable;
        $this->user         = $user;
        $imageTable->insertOrUpdate($this->getId(), $this->getTableValues());
    }

    // -----------------------------------------------
    // Public methods
    // -----------------------------------------------

    /**
     * Sets the user of the image.
     *
     * @param $user - user's name
     */
    public function setUser($user) {
        $this->user = $user;
    }

    // -----------------------------------------------
    // Overridden methods (from Image)
    // -----------------------------------------------

    public function setDescription($description) {
        parent::setDescription($description);
        $this->imageTable->updateDescription($this->getId(), $this->getDescription());
    }

    public function removeDescription() {
        parent::removeDescription();
        $this->imageTable->updateDescription($this->getId(), $this->getDescription());
    }

    public function setFavorite($is) {
        $this->imageTable->updateFavorite($this->getId(), $this->isFavorite());
    }

    // -----------------------------------------------
    // Private methods
    // -----------------------------------------------

    /**
     * Gets the values to insert into the table.
     *
     * @return array
     */
    private function getTableValues() {
        return array(   $this->getId(),
                        $this->user,
                        $this->getUrl(),
                        $this->getName(),
                        $this->getDescription(),
                        $this->isFavorite());
    }

}