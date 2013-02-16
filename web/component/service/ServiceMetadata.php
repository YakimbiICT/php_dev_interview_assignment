<?php

/**
 * This class provides simple metadata of the external service.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
interface ServiceMetadata {

    /**
     * Gets id of the service resource.
     *
     * @return string
     */
    function getId();

    /**
     * Gets the url of the service resource.
     *
     * @return string
     */
    function getUrl();

    /**
     * Gets the name of the service resource.
     *
     * @return string
     */
    function getName();

}