<?php

/**
 * Simple User. This user has only name.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
interface Image {

    /**
     * Gets the id of the image.
     *
     * @return string
     */
    function getId();

    /**
     * Gets external url of the image.
     *
     * @return string
     */
    function getUrl();

    /**
     * Gets the name of the image.
     *
     * @return string
     */
    function getName();

    /**
     * Gets the description attached to the image.
     *
     * @return string
     */
    function getDescription();

    /**
     * Sets the image description.
     *
     * @param string $description - image description
     */
    function setDescription($description);

    /**
     * Removes the image description.
     */
    function removeDescription();

    /**
     * Checks if image is a favorite image.
     *
     * @return boolean
     */
    function isFavorite();

    /**
     * Sets or unsets the image as favorite image.
     *
     * @param $is - favorite status - true if its favorite; false if not
     */
    function setFavorite($is);

    /**
     * Converts the image data to an array.
     *
     * @return array
     */
    function toArray();

}