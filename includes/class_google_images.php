<?php

class google_images {

    /**
     *  Get random images from google 
     * 
     * @return array
     */
    
    public function get_random() {


        $gphotos_api_key = "ABQIAAAA7c6m-KCjHcAzIKEjpi4XghT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRkYs5UXg5PEbYUNMGmmdsVCrC8xQ";
        $max_results = 20;
        $photos_perpage = 5;
        $start = rand(0, 40);
        $keyword = 'malaysia';
        $max_start = $start + $max_results;


        $c = 0;
        $data = array();

        while ($start < $max_start) {

            $url = "http://ajax.googleapis.com/ajax/services/search/images?" .
                    "v=1.0&q=" . $keyword . "&key=" . $gphotos_api_key . "&userip=" . getenv("REMOTE_ADDR") . "&start=" . $start . "&rsz=$photos_perpage&imgsz=large&as_filetype=jpg|png|gif";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_REFERER, "http://" . $_SERVER['HTTP_HOST']);
            $body = curl_exec($ch);
            curl_close($ch);

            $jset = json_decode($body, true);
            $result = $jset["responseData"]["results"];

            if (count($result)) {
                $start += $photos_perpage;

                foreach ($result as $dtx) {
                    $data[] = array(
                        "description" => $dtx["contentNoFormatting"],
                        "url" => $dtx['unescapedUrl'],
                        "thumb" => $dtx['tbUrl'],
                        "width" => $dtx['width'],
                        "height" => $dtx['height']
                    );
                }
            } else {
                $start = $max_start;
            }
        }

        return $data;
    }

}

?>
