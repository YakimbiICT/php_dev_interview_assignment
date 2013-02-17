<?php

require 'DB.class.php';
require 'Images.class.php';
require 'User.class.php';

$database = new DB();
$db = $database->getInstance();

$user = new User();
$auth_val = '';
if (isset($_GET['auth_key'])) {
    $auth_val = $_GET['auth_key'];
}
if (isset($_GET['format'])) {
    $format = $_GET['format'];
}
$authentication = $user->getUserInfo($auth_val); // Authenticate request based on user auth_key
if (!$authentication) {
    $results = Array(
        'head' => Array(
            'status' => 0,
            'error_message' => 'Authentication failed.'
        ),
        'body' => Array()
    );
} else {
    // Method to be executed
    $method = $_GET['method'];
    switch ($method) {
        case 'getimages' : // Get random images based on search tag
            $img = new Images();
            $images = $img->getRandomImages(flickr_api_key, $_GET['searchtag'], flickr_search_count);
            if ($images && count($images) > 0) {
                foreach ($images as $key => $image) {
                    $img_arr[$key]['title'] = $image->title;
                    $img_arr[$key]['thumb'] = 'http://farm' . $image->farm . '.staticflickr.com/' . $image->server . '/' . $image->id . '_' . $image->secret . '_q.jpg';
                    $img_arr[$key]['image'] = 'http://farm' . $image->farm . '.staticflickr.com/' . $image->server . '/' . $image->id . '_' . $image->secret . '.jpg';
                }
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array(
                        'image_array' => $img_arr
                    )
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => Array()
                );
            }
            break;
        case 'getfavouriteimages' : // Get favourite images of a person
            $img = new Images();
            $images = $img->getUserImages($_GET['user_id']);
            if ($images && count($images) > 0) {
                foreach ($images as $key => $image) {
                    $img_arr[$image['id']]['title'] = $image['image_title'];
                    $img_arr[$image['id']]['thumb'] = $image['image_thumb_url'];
                    $img_arr[$image['id']]['image'] = $image['image_url'];
                    ;
                    $img_arr[$image['id']]['description'] = $image['image_description'];
                }
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array(
                        'image_array' => $img_arr
                    )
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => Array()
                );
            }
            break;
        case 'favourite' : // Favourite an image
            $img = new Images();
            $img_id = $img->addImage($_GET['user_id'], $_GET['title'], $_GET['url'], $_GET['thumb'], $_GET['description']);
            if ($img_id) {
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array(
                        'id' => $img_id
                    )
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => NULL
                );
            }
            break;
        case 'unfavourite' : // Un-favourite an image
            $img = new Images();
            $img_id = $img->removeImage($_GET['id']);
            if ($img_id) {
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array()
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => NULL
                );
            }
            break;
        case 'adddescription' : // Add description to an favourited image
            $img = new Images();
            $desc_update = $img->updateDescription($_GET['id'], $_GET['description']);
            if ($desc_update) {
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array()
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => NULL
                );
            }
            break;
        case 'removedescription' : // Remove description of an favourited image
            $img = new Images();
            $desc_update = $img->updateDescription($_GET['id'], '');
            if ($desc_update) {
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array()
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => NULL
                );
            }
            break;
        case 'updatedescription' : // Update description of an favourited image
            $img = new Images();
            $desc_update = $img->updateDescription($_GET['id'], $_GET['description']);
            if ($desc_update) {
                $results = Array(
                    'head' => Array(
                        'status' => 1
                    ),
                    'body' => Array()
                );
            } else {
                $results = Array(
                    'head' => Array(
                        'status' => '0',
                        'error_message' => 'Request failed.'
                    ),
                    'body' => NULL
                );
            }
            break;
        default :
            $results = Array(
                'head' => Array(
                    'status' => '0',
                    'error_message' => 'Invalid method.'
                ),
                'body' => NULL
            );
    }
}

// Format to return result
switch ($format) {
    case 'json' :
        $results = json_encode($results);
        break;
    case 'phpserialize' :
        $results = serialize($results);
        break;
    default :
        $results = json_encode($results);
        break;
}
//echo "<pre>";
echo $results;