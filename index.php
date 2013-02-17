<?php
session_start();
require 'Images.class.php';
require 'User.class.php';
require 'DB.class.php';
$user = new User();
$images = new Images();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PHP TEST</title>
        <link rel="stylesheet" type="text/css" href="scripts/style.css"></script>
            <link rel="stylesheet" type="text/css" href="scripts/jquery-lightbox/css/jquery.lightbox-0.5.css" media="screen" />
    </head>
    <body>
        <div id="wrapper">
            <div id="top">
                <div class="logo">PHP TEST</div>
                <div class="clear"></div>
            </div>
            <div id="content">
                <?php
                $user_auth = $user->getUser();

                if (isset($_POST['submit']) && $_POST['search_tag'] && $_POST['search_tag'] != '') {
                    $post_search_tag = $search_tag = $_POST['search_tag'];
                } else {
                    $post_search_tag = "";
                    $search_tag = flickr_search_tag;
                }

                // Get random images from flickr
                $url = BASE_URL.'api.php?method=getimages&auth_key='.$_SESSION['auth_key'].'&searchtag='.$search_tag.'&format=json';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER,0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $k = json_decode(curl_exec($ch));
                curl_close($ch);
                if (isset($k) && $k->head->status == '1') {
                    $img_arr = $k->body->image_array;
                } else {
                    $img_arr = array();
                }
                ?>
                <div id="div_search">
                <form action="" name="search" id="search" method="post">
                    <input type="text" name="search_tag" id="search_tag" value="<?php echo $post_search_tag; ?>" />
                    <input type="submit" name="submit" id="submit" value="Search Random Images" /> OR <a href="">GET ME ANYTHING</a> | <a href="view_favourites.php">VIEW MY FAVOURITES</a>
                </form>
                    </div>
                <?php if (isset($img_arr) && count($img_arr) > 0) { ?>
                    <div id="gallery">
                        <ul>
                            <?php foreach ($img_arr as $k => $img_element) { ?>
                                <li id="li_<?php echo $k; ?>">
                                    <a href="<?php echo $img_element->image; ?>" title="">
                                        <img src="<?php echo $img_element->thumb; ?>" alt="" />
                                    </a>
                                    <div class="options" id="options_<?php echo $k; ?>">
                                        <div class="like" value="<?php echo $k; ?>" id="like_<?php echo $k; ?>"><img src='scripts/images/like.png' width="20px" height="20px" title="Click to favourite"></div>
                                        <div class="remove_description" value="<?php echo $k; ?>" id="remvove_description_<?php echo $k; ?>"></div>
                                        <div class="description" value="<?php echo $k; ?>" id="description_<?php echo $k; ?>"></div>
                                        <div class="image_description" id="image_description_<?php echo $k;?>" title=""></div>
                                        <input type="hidden" id="title_<?php echo $k; ?>" name="title_<?php echo $k; ?>" value="<?php echo $img_element->title; ?>"></input>
                                        <input type="hidden" id="url_<?php echo $k; ?>" name="url_<?php echo $k; ?>" value="<?php echo $img_element->image; ?>"></input>
                                        <input type="hidden" id="thumburl_<?php echo $k; ?>" name="thumburl_<?php echo $k; ?>" value="<?php echo $img_element->thumb; ?>"></input>
                                        <input type="hidden" id="description_<?php echo $k; ?>" name="description_<?php echo $k; ?>" value=""></input>
                                    </div>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                <?php }else{ ?>
                <div id="gallery">
                    <div style=" margin-top: 40px;">No images imported. Please try again.</div>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        var base_url = '<?php echo BASE_URL; ?>';
        var user_id = '<?php echo $_SESSION['user_id']; ?>';
        var auth_key = '<?php echo $_SESSION['auth_key']; ?>';
    </script>
    <script type="text/javascript" src="scripts/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-lightbox/js/jquery.lightbox-0.5.js"></script>
    <script type="text/javascript" src="scripts/js.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#gallery a').lightBox();
        });
    </script>
</html>