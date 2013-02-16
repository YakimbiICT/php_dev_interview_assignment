<?php

/**
 * Table class for generated images.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class ImageTable extends SimpleTable {

    // -----------------------------------------------
    // Constants
    // -----------------------------------------------

    /**
     * Table's name.
     */
    const TABLE_NAME = 'images';

    /**
     * Table field. Image's id.
     */
    const FIELD_ID  = 'id';

    /**
     * Table field. Image's user.
     */
    const FIELD_USER = 'user';

    /**
     * Table field. Image's url.
     */
    const FIELD_URL = 'url';

    /**
     * Table field. Image's name.
     */
    const FIELD_NAME = 'name';

    /**
     * Table field. Image's description.
     */
    const FIELD_DESCRIPTION = 'description';

    /**
     * Table field. Indicates if image is favorite or not.
     */
    const FIELD_FAVORITE = 'isFavorite';

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * @param Database $database - database used to work with this table
     */
    public function __construct(Database $database) {
        parent::__construct(self::TABLE_NAME, $database);
    }

    // -----------------------------------------------
    // Public methods
    // -----------------------------------------------

    /**
     * Gets the list of the rows only with specific user name.
     *
     * @param $user - the user name
     * @return null|array
     */
    public function getListByUser($user) {
        $condition = $this->getUserCondition($user) . " AND `" . self::FIELD_FAVORITE . "`='0'";
        return $this->getDatabase()->select(self::TABLE_NAME,
                                            null,
                                            $condition,
                                            $this->getTablePrimaryRow(),
                                            null);
    }

    /**
     * Gets the list of favorite images of the specific user.
     *
     * @param $user - the user name
     * @return null|array
     */
    public function getFavoriteList($user) {
        $condition = $this->getUserCondition($user) . " AND `" . self::FIELD_FAVORITE . "`='1'";
        return $this->getDatabase()->select(self::TABLE_NAME,
                                            null,
                                            $condition,
                                            $this->getTablePrimaryRow(),
                                            null);
    }

    /**
     * Updates description of the specific image.
     *
     * @param $id - id of the image in the database
     * @param $description - new image's description
     * @return bool
     */
    public function updateDescription($id, $description) {
        // TODO: so rough. change.
        $description = htmlspecialchars(mysql_real_escape_string($description));
        return $this->getDatabase()->update(self::TABLE_NAME,
                                            array(self::FIELD_DESCRIPTION),
                                            array($description),
                                            $this->getPrimaryCondition($id));
    }

    /**
     * Deletes all images binded to specific user.
     *
     * @param $user - user which images will be deleted
     * @return bool
     */
    public function deleteByUser($user) {
        return $this->getDatabase()->delete(self::TABLE_NAME, "`" . self::FIELD_USER . "`='$user'");
    }

    /**
     * Deletes all rows with specific favorite status.
     *
     * @param $user - user which images will be deleted
     * @param $favoriteStatus - with this favorite status data will be removed
     * @return bool
     */
    public function deleteWithFavoriteStatus($user, $favoriteStatus) {
        return $this->getDatabase()->delete(self::TABLE_NAME, "`" . self::FIELD_USER . "`='$user' AND "
                                          . self::FIELD_FAVORITE . "='" . ($favoriteStatus ? '1' : '0') . "'");
    }

    /**
     * Updates image status - sets its status to favorite or not.
     *
     * @param $id - id of the image in the database
     * @param $isFavorite - set the image favorite or not favorite
     * @return bool
     */
    public function updateFavorite($id, $isFavorite) {
        return $this->getDatabase()->update(self::TABLE_NAME,
                                            array(self::FIELD_FAVORITE),
                                            array($isFavorite ? '1' : '0'),
                                            $this->getPrimaryCondition($id));
    }

    // -----------------------------------------------
    // Protected methods
    // -----------------------------------------------

    protected function getPrimaryCondition($key) {
        // TODO: so rough. change.
        $key = mysql_real_escape_string($key);
        return "`" . self::FIELD_ID . "`='" . $key . "'";
    }

    protected function getTableRows() {
        return array(   self::FIELD_ID,
                        self::FIELD_USER,
                        self::FIELD_URL,
                        self::FIELD_NAME,
                        self::FIELD_DESCRIPTION,
                        self::FIELD_FAVORITE
                    );
    }

    protected function getTableRowTypes() {
        return array(   'VARCHAR(25)',
                        'VARCHAR(255)',
                        'VARCHAR(255)',
                        'VARCHAR(100)',
                        'VARCHAR(500)',
                        'BOOL');
    }

    protected function getTablePrimaryRow() {
        return self::FIELD_ID;
    }

    // -----------------------------------------------
    // Private methods
    // -----------------------------------------------

    /**
     * Builds the condition using specific user name.
     *
     * @param $user
     * @return string
     */
    private function getUserCondition($user) {
        return " `" . self::FIELD_USER . "`='$user'";
    }

}