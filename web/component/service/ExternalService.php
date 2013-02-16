<?php

/**
 * Provides the functionality to work with the external service and its data.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
interface ExternalService {

    /**
     * Loads and returns metadata from an external service.
     *
     * @return ServiceMetadata[]
     */
    function loadMetadata();

}