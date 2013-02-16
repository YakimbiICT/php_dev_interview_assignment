<?php

/**
 * Very, very rough and trivial interface to work with the database.
 * Encapsulates all basic operations to the database.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
interface Database {

    /**
     * Checks if connection with the database is set or not.
     *
     * @return boolean
     */
    function isConnected();

    /**
     * Gets the last occurred error.
     *
     * @return string
     */
    function getError();

    /**
     * Closes the connection with the server
     */
    function close();

    /**
     * Inserts a new row into the table
     *
     * @param $table - name of the table where the data will be inserted
     * @param array $values - array of values to be inserted
     * @return boolean
     */
    function insert($table, array $values);

    /**
     * Selects the data from the table.
     *
     * @param $table - name of the table data will be selected from
     * @param $fields - array of the field names to select
     * @param $where - select condition
     * @param $order - order of the values to be sorted
     * @param $limit - maximal number of rows to be selected
     * @return array|null
     */
    function select($table, $fields, $where, $order, $limit);

    /**
     * Updates the data in the table.
     *
     * @param $table - name of the table data will be updated
     * @param array $rows - name of the rows to be updated
     * @param array $values - new values specifically to the list of rows
     * @param $where - update condition
     * @return boolean
     */
    function update($table, array $rows, array $values, $where);

    /**
     * Deletes the data from the table.
     *
     * @param $table - name of the table where data will be deleted
     * @param $where - delete condition
     * @return boolean
     */
    function delete($table, $where);

    /**
     * Gets the number of rows in the selected table.
     *
     * @param $table - table where rows will be counted
     * @param $where - count condition
     * @return int
     */
    function getCount($table, $where);

    /**
     * Creates a new table in the database.
     *
     * @param $table - name of the table to be created
     * @param array $names - names of the table's fields
     * @param array $types - types of the table's fields
     * @param $primaryKey - name of the primary key of the table
     * @return boolean
     */
    function createTable($table, array $names, array $types, $primaryKey);

    /**
     * Checks if table exists in the database.
     *
     * @param $name - name of the table to check.
     * @return boolean
     */
    function isTable($name);

}