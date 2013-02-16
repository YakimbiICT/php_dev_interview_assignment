<?php

/**
 * Provides metadata loading from the Flikr image service (http://flikr.com).
 * To create this class instance use ExternalServiceFactory class.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class FlikrService implements ExternalService {

    // -----------------------------------------------
    // Overridden methods
    // -----------------------------------------------

    /**
     * {@inheritdoc}
     *
     * @return ServiceMetadata[]
     */
    public function loadMetadata() {

        // this is simple app, but of cause in real life we should
        // inject library include, api key and number of images to load.

        // load the library and get the photos
        require_once 'lib/flikr_api/phpFlickr.php';
        $flikr  = new phpFlickr('9b985e64566c121ccdfa5c2b0d49cd2e');
        $photos = $flikr->photos_getRecent(null, null, 20);
        $images = array();

        // convert to image objects
        foreach ($photos['photos']['photo'] as $photo) {

            $images[] = new ServiceMetadataImpl(  $photo['id'],
                                                  $flikr->buildPhotoURL($photo, 'large square'),
                                                  $photo['title']);
        }

        return $images;
    }

}

