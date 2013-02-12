<?php
namespace Imact\Test\Model\Adaptor;

use Imact\Test\Base as Core;

/**
 * Unit testing Imact_Model_Image_Imgur
 *
 */

class ImgurTest extends Core
{

    protected $param = array("read" => array("me6rHjK"));

    public function read($id="")
    {
        $response = $this->counterpart->read($id);

        //This could all be done neatly using extended Zend form validation or PHP unit for example

        if (is_string($response)) {
            $this->assert(false, "Exception captured, no data returned from imgur API");
        } else {

            $this->format($response, 'Array');
            $this->exists($response);
            $this->equals($response['success'], true);
            $this->equals($response['status'], '200');
            $this->equals($response['data']['id'], $id);

        }
    }
}
