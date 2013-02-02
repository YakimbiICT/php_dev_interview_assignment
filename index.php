<?php
/*
 * Yakimbi PHP Developer Task
 * 
 * @author  Ali Allomani <info@allomani.com>
 */
require("./global.php");
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="js/js.js"></script>
        <link rel="stylesheet" href="css/style.css" />
        <title>Yakimbi Images Hosting</title>

    </head>
    <body>

        <div id="loading"><img src="images/loading.gif" /></div>

        <input type="button" id="get_random" value="Get Random">
        <div id="random_div"><ul class="thumbs"></ul></div>

        <div class="clear"></div>
        <h1>Favorite</h1>
        <div id="favorites_div">
            <?
            $fav = $app->get_favorites();
            if (count($fav)) {
                ?>
                <ul class="thumbs">
                <?
                foreach ($fav as $data) {
                    ?>
                        <li id="img_li_<?=$data['id'];?>">
                            <a href="<?= $data['img_url']; ?>" target="_blank">
                                <img src="<?= $data['thumb_url']; ?>" id="img_<?=$data['id'];?>" title="<?= $data['description']; ?>">
                            </a>
                            <input type="button" rel="<?= $data['id']; ?>" class="edit_it" value="Edit" onClick="return edit_it($(this).attr('rel'));">
                            <input type="button" rel="<?= $data['id']; ?>" class="delete_it" value="Delete" onClick="return delete_it($(this).attr('rel'));">
                        </li>
        <?
    }
    ?>
                </ul>
                    <?
                } else {
                    ?>
                <div id="no_favorite">No Favorites</div>
                <ul class="thumbs"></ul>
    <?
}
?>
        </div>
    </body>
</html>

