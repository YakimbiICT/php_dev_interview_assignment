<?php

/**
 * Implementation of the Database interface, implement work with the MySQL server.
 *
 * TODO: switch to PDO, or mysqli, or even better use stable, tested and verified ORM library.
 * this class uses mysql_* functions that aren't safe and deprecated at all.
 * But I decided to use them instead of pdo, mysqli or any ORM library to show
 * my understanding of the those wrappers work behind all frameworks and libraries.
 *
 * @author Umed Khudoiberdiev <info@zar.tj>
 */
class MysqlDatabase implements Database {

    // -----------------------------------------------
    // Private properties
    // -----------------------------------------------

    /**
     * Connection with the mysql database instance.
     *
     * @var resource
     */
    private $connection;

    // -----------------------------------------------
    // Constructor and destructor
    // -----------------------------------------------

    /**
     * Opens connection to the database.
     *
     * @param $server - remote server
     * @param $user - user name
     * @param $password - user password
     * @param $database - database to be used for
     */
    public function __construct($server, $user, $password, $database) {

        $this->connection = mysql_connect($server, $user, $password);
        if ($this->isConnected()) {
            if (!mysql_select_db($database))
                $this->close();
        }
    }

    /**
     * Closes connection with the mysql server when object destructs.
     */
    public function __destruct() {
        $this->close();
    }

    // -----------------------------------------------
    // Overridden methods (from Database)
    // -----------------------------------------------

    public function getError() {
        return mysql_error($this->connection);
    }

    public function close() {
        if ($this->isConnected()) {
            mysql_close($this->connection);
        }
    }

    public function isConnected() {
        return $this->connection != null;
    }

    public function insert($table, array $values) {
        $valuesString = "'" . implode("', '", /*array_map('mysql_real_escape_string', */$values)/*)*/ . "'";
        return mysql_query("INSERT INTO `$table` VALUES ($valuesString)", $this->connection);
    }

    public function select($table, $fields, $where, $order, $limit) {

        $query = '';
        if (empty($fields))
            $fields = '*';
        if (!empty($where))
            $query .= " WHERE $where";
        if (!empty($order))
            $query .= " ORDER BY $order";
        if (!empty($limit))
            $query .= " LIMIT $limit";

        $result = mysql_query("SELECT $fields FROM `$table`" . $query, $this->connection);

        if (mysql_num_rows($result) > 0) {
            $arr = array();
            while ($row = mysql_fetch_array($result)) {
                $arr[] = $row;
            }

            return $arr;
        }

        return null;
    }

    public function update($table, array $rows, array $values, $where) {

        // build query
        $query = '';
        //$values = array_map('mysql_real_escape_string', $values);
        for ($i = 0, $cnt = count($rows); $i < $cnt; $i++)
            if (isset($values[$i]))
                $query .= "`$rows[$i]`='$values[$i]', ";
        $query = trim($query, ', ');
        if (!empty($where))
            $query .= " WHERE $where";

        return mysql_query("UPDATE `$table` SET " . $query, $this->connection);
    }

    public function delete($table, $where) {
        $query = '';
        if (!empty($where))
            $query .= " WHERE $where";

        return mysql_query("DELETE FROM `$table`" . $query, $this->connection);
    }

    public function getCount($table, $where) {

        $query = mysql_query("SELECT * FROM `$table`" . $where, $this->connection);
        if (!empty($query))
            return mysql_num_rows($query);
        else
            return -1;
    }

    public function createTable($table, array $names, array $types, $primaryKey) {

        // build query
        $query = "CREATE TABLE `$table` (";
        for ($i = 0, $cnt = count($names); $i < $cnt; $i++)
            if (isset($types[$i]))
                $query .= "`$names[$i]` $types[$i], ";
        if (!empty($primaryKey))
            $query .= " PRIMARY KEY ($primaryKey)";
        $query = trim($query, ',') . ')';

        return mysql_query($query, $this->connection);
    }

    public function isTable($name) {
        $result = mysql_query("SHOW TABLES LIKE '$name'");
        if ($result != null)
            return mysql_num_rows($result) > 0;

        return false;
    }

}