<?php

/**
 * Simple User. This user has only name.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class User {

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    function __construct() {
        // TODO: store the user in the cookies
        if (session_id() == '')
            session_start();
    }

    // -----------------------------------------------
    // Public methods (from Image)
    // -----------------------------------------------

    /**
     * Gets the name of the user.
     *
     * @return string
     */
    public function getName() {
        // TODO: so rough. change.
        if (isset($_COOKIE['user']))
            return htmlspecialchars(mysql_real_escape_string($_COOKIE['user']));

        return session_id();
    }

}