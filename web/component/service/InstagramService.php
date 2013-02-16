<?php

/**
 * Provides metadata loading from the Instagram service (http://instagram.com).
 * To create this class instance use ExternalServiceFactory class.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class InstagramService implements ExternalService {

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

        require_once 'lib/instagram_api/instaphp.php';
        $api    = Instaphp\Instaphp::Instance();
        $res    = $api->Media->Popular();
        $images = array();

        // convert to objects
        if (empty($res->error)) {
            foreach ($res->data as $item) {
                $images[] = new ServiceMetadataImpl(  $item->id,
                                                      $item->images->thumbnail->url,
                                                      $item->caption->text);
            }
        }

        return $images;
    }

}

