<?php

/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */

class api {

    public function __construct() {
        $this->app = app::instance();
    }

    public function get($action) {
        if (!in_array($action, get_class_methods($this))) {
            throw new Exception("Invalid Command");
        }

        return $this->$action();
    }

    /**
     * Get Random Images Action
     */
    private function get_random() {
        $g = new google_images();
        $random = $g->get_random();
        return json_encode($random);
    }

    /**
     * Favorite an image Action
     */
    private function favorite_it() {
        return $this->app->add_favorite($_POST['img_data']);
    }

    /**
     * Edit favorite image Action
     */
    private function favorite_edit() {

        $img_data = $_POST['img_data'];

        return $this->app->edit_favorite($img_data);
    }

    /*
     * Delete avorite image Action
     * 
     */

    private function favorite_del() {
        $id = (int) $_POST['id'];
        return $this->app->del_favorite($id);
    }

    /**
     *  Get Favorite images
     * 
     * @return array
     */
    private function favorites_get() {
        
        $favs = (array) $this->app->get_favorites();
        return json_encode($favs);
    }

}

?>
