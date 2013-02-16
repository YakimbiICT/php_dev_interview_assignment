<?php

/**
 * Base abstraction of the simple database tables.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
abstract class SimpleTable {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * Database used by this table.
     *
     * @var Database
     */
    private $database;

    /**
     * Table's name.
     *
     * @var string
     */
    private $tableName;

    // -----------------------------------------------
    // Constructor
    // -----------------------------------------------

    /**
     * Constructs a new table instance.
     *
     * @param $tableName - name of the table
     * @param Database $database - database used by this table
     */
    public function __construct($tableName, Database $database) {
        $this->tableName = $tableName;
        $this->database  = $database;
        $this->install();
    }

    // -----------------------------------------------
    // Public methods
    // -----------------------------------------------

    /**
     * Gets the list of the table's rows.
     *
     * @return null|resource
     */
    public function getList() {
        return $this->database->select($this->tableName, null, null, $this->getTablePrimaryRow(), null);
    }

    /**
     * Deletes a row with specific key.
     *
     * @param $key - row with this key will be deleted
     */
    public function delete($key) {
        $this->database->delete($this->tableName, $this->getPrimaryCondition($key));
    }

    /**
     * Inserts a row or updates if its already exists.
     *
     * @param $key - key to be checked before update
     * @param $values - new row values
     */
    public function insertOrUpdate($key, $values) {

        if ($this->isInserted($key) == false)
            $this->database->insert($this->tableName, $values);
        else
            $this->database->update($this->tableName,
                                    $this->getTableRows(),
                                    $values,
                                    $this->getPrimaryCondition($key));
    }

    /**
     * Gets the Database instance used by this table.
     *
     * @return Database
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * Deletes all the data from the table.
     */
    public function clear() {
        $this->database->delete($this->tableName, null);
    }

    // -----------------------------------------------
    // Private methods
    // -----------------------------------------------

    /**
     * Installs a table if its not installed yet.
     */
    private function install() {
        if (!$this->database->isTable($this->tableName))
            $this->database->createTable(   $this->tableName,
                                            $this->getTableRows(),
                                            $this->getTableRowTypes(),
                                            $this->getTablePrimaryRow());
    }

    /**
     * Checks if row with specific key is exists or not.
     *
     * @param $key - key to be checked
     * @return bool
     */
    private function isInserted($key) {
        return $this->database->getCount($this->tableName, $this->getPrimaryCondition($key)) > 0;
    }

    // -----------------------------------------------
    // Abstract methods
    // -----------------------------------------------

    /**
     * Returns main condition usually used to perform condition with primary key.
     * For example it can be "id='$key'" condition.
     *
     * @param $key - primary key's value passed to build condition
     * @return string
     */
    protected abstract function getPrimaryCondition($key);

    /**
     * Gets an array of all table row names.
     *
     * @return array
     */
    protected abstract function getTableRows();

    /**
     * Gets an array of all table row types.
     *
     * @return array
     */
    protected abstract function getTableRowTypes();

    /**
     * Gets the key name of the table's primary row.
     *
     * @return string
     */
    protected abstract function getTablePrimaryRow();

}