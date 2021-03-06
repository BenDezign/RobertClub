<?php

/**
 * Database class, Db.php
 * Database management
 * @category classes
 *
 * @author PrestaShop <support@prestashop.com>
 * @copyright PrestaShop
 * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
 * @version 1.2
 *
 */
include_once(dirname(__FILE__) . '/MySQL.class.php');

abstract class Db {

    /** @var string Server (eg. localhost) */
    protected $_server;

    /** @var string Database user (eg. root) */
    protected $_user;

    /** @var string Database password (eg. can be empty !) */
    protected $_password;

    /** @var string Database type (MySQL, PgSQL) */
    protected $_type;

    /** @var string Database name */
    protected $_database;

    /** @var mixed Ressource link */
    protected $_link;

    /** @var mixed SQL cached result */
    protected $_result;

    /** @var mixed ? */
    protected static $_db;

    /** @var mixed Object instance for singleton */
    private static $_instance;
    protected $_debug;

    /**
     * Get Db object instance (Singleton)
     *
     * @return object Db instance
     */
    public static function getInstance() {
        if (!isset(self::$_instance))
            self::$_instance = new MySQL();
        return self::$_instance;
    }

    public function __destruct() {
        return true;
        //$this->disconnect();
    }

    /**
     * Build a Db object
     */
    public function __construct($_server, $_user, $_password, $_database, $_debug = 0, $_type = 'MySQL') {
        $this->_server = $_server;
        $this->_user = $_user;
        $this->_password = $_password;
        $this->_type = $_type;
        $this->_database = $_database;
        $this->debug = $_debug;
        $this->connect();
    }

    /**
     * Filter SQL query within a blacklist
     *
     * @param string $table Table where insert/update data
     * @param string $values Data to insert/update
     * @param string $type INSERT or UPDATE
     * @param string $where WHERE clause, only for UPDATE (optional)
     * @param string $limit LIMIT clause (optional)
     * @return mixed|boolean SQL query result
     */
    public function autoExecute($table, $values, $type, $where = false, $limit = false) {       
        if (!sizeof($values))
            return true;

        if (strtoupper($type) == 'INSERT') {
            $query = 'INSERT INTO ' . $table . ' (';
            foreach ($values AS $key => $value)
                $query .= '' . $key . ',';
            $query = rtrim($query, ',') . ') VALUES (';

            foreach ($values AS $key => $value) {
                if ($this->_type == 'PgSql')
                    $query .= '\'' . pg_escape_string($this->_link, $value) . '\',';
                else
                    $query .= '\'' . mysqli_real_escape_string($this->_link, $value) . '\',';
            }
            $query = rtrim($query, ',') . ')';
            if ($limit)
                $query .= ' LIMIT ' . intval($limit);

            $this->getDebug($query);
            //echo $query.'<br />';
//            exit;
            return $this->q($query);
        }
        elseif (strtoupper($type) == 'UPDATE') {
            $query = 'UPDATE ' . $table . ' SET ';
            foreach ($values AS $key => $value) {
                if ($this->_type == 'PgSql')
                    $query .= '' . $key . ' = \'' . pg_escape_string($this->_link, $value) . '\',';
                else
                    $query .= '' . $key . ' = \'' . mysqli_real_escape_string($this->_link, $value) . '\',';
            }
            $query = rtrim($query, ',');
            if ($where)
                $query .= ' WHERE ' . $where;
            if ($limit)
                $query .= ' LIMIT ' . intval($limit);
            $this->getDebug($query);
//           echo $query.'<br />';
//            exit;
            return $this->q($query);
        }

        return false;
    }

    /**
     * Filter SQL query within a blacklist
     *
     * @param string $table Table where insert/update data
     * @param string $values Data to insert/update
     * @param string $type INSERT or UPDATE
     * @param string $where WHERE clause, only for UPDATE (optional)
     * @param string $limit LIMIT clause (optional)
     * @return mixed|boolean SQL query result
     */
    public function autoExecuteWithNullValues($table, $values, $type, $where = false, $limit = false) {
        if (!sizeof($values))
            return true;

        if (strtoupper($type) == 'INSERT') {
            $query = 'INSERT INTO ' . $table . ' (';
            foreach ($values AS $key => $value)
                $query .= '' . $key . ',';
            $query = rtrim($query, ',') . ') VALUES (';
            foreach ($values AS $key => $value)
                $query .= (($value === '' OR $value === NULL) ? 'NULL' : '\'' . $value . '\'') . ',';
            $query = rtrim($query, ',') . ')';
            if ($limit)
                $query .= ' LIMIT ' . intval($limit);
            return $this->q($query);
        }
        elseif (strtoupper($type) == 'UPDATE') {
            $query = 'UPDATE ' . $table . ' SET ';
            foreach ($values AS $key => $value)
                $query .= '' . $key . ' = ' . (($value === '' OR $value === NULL) ? 'NULL' : '\'' . $value . '\'') . ',';
            $query = rtrim($query, ',');
            if ($where)
                $query .= ' WHERE ' . $where;
            if ($limit)
                $query .= ' LIMIT ' . intval($limit);
            return $this->q($query);
        }

        return false;
    }

    /*     * *******************************************************
     * ABSTRACT METHODS
     * ******************************************************* */

    /**
     * Open a connection
     */
    abstract public function connect();

    /**
     * Get the ID generated from the previous INSERT operation
     */
    abstract public function Insert_ID();

    /**
     * Get number of affected rows in previous databse operation
     */
    abstract public function Affected_Rows();

    /**
     * Gets the number of rows in a result
     */
    abstract public function NumRows();

    /**
     * Delete
     */
    abstract public function delete($table, $where = false, $limit = false);

    /**
     * Fetches a row from a result set
     */
    abstract public function Execute($query);

    /**
     * Fetches an array containing all of the rows from a result set
     */
    abstract public function ExecuteS($query, $array = true);

    /*
     * Get next row for a query which doesn't return an array
     */

    abstract public function nextRow($result = false);

    /**
     * Alias of Db::getInstance()->ExecuteS
     *
     * @acces string query The query to execute
     * @return array Array of line returned by MySQL
     */
    static public function s($query) {
        return Db::getInstance()->ExecuteS($query);
    }

    static public function ps($query) {
        $ret = Db::s($query);
        p($ret);
        return $ret;
    }

    static public function ds($query) {
        Db::s($query);
        die();
    }

    /**
     * Get Row and get value
     */
    abstract public function getRow($query);

    abstract public function getValue($query);

    /**
     * Returns the text of the error message from previous database operation
     */
    abstract public function getMsgError();
}

/**
 * Convert \n to  New string
 */
function nl2br2($string) {
    return str_replace(array("\r\n", "\r", "\n"), '<br />', $string);
}

?>