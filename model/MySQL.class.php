<?php

/**
 * MySQLi class, MySQL.php
 * MySQLs management
 * @category classes
 *
 */
class MySQL extends Db {

    public function connect() {
        if (!@mysqli_ping($this->_link)) {
            $this->_link = mysqli_connect($this->_server, $this->_user, $this->_password);
            if ($this->_link) {
                if (!$this->set_db($this->_database))
                    die(Tools::displayError('The database selection cannot be made.'));
            } else
                die('
				    <div style="width: 420px; padding:50px; margin:200px auto; font-size:12px;color:#333; border:1px solid #CCCCCC; -moz-border-radius: 5px;background-color:#FFFF00; font-family:verdana; ">
				   	 Ohhh! <br />
					 Une erreur technique est survenue  ... <br />
					 Ne vous inquietez pas, je vais réparer ça en un tour de main !<br /><br />
					 Gus.
					</div>
				    ');
            /* UTF-8 support */
            if (!mysqli_query($this->_link, 'SET NAMES \'utf8\''))
                die(Tools::displayError('Fatal error: no utf-8 support. Please check your server configuration.'));
            /* Disable some MySQL limitations */
            mysqli_query($this->_link, 'SET GLOBAL SQL_MODE=\'\'');
            //echo '<br />Connexion open for '.$this->_link.'<br />';
            return $this->_link;
        }else {
            echo '<br />No Connexion needed<br />';
        }
    }

    /* do not remove, useful for some modules */

    public function set_db($db_name) {
        return mysqli_select_db($this->_link, $db_name);
    }

    public function disconnect() {
        if ($this->_link)
            @mysqli_close($this->_link);
        $this->_link = false;
    }

    public function getDebug($query) {
        if ($this->debug == 1) {
            echo '<div style=" position absolute; color:#FFF; background:#333;">
			' . strip_tags($query) . '<br />
			</div>';
        }
    }

    public function getRow($query) {
        $this->getDebug($query);
        $this->_result = false;
        if ($this->_link)
            if ($this->_result = mysqli_query($this->_link, $query . ' LIMIT 1'))
                return mysqli_fetch_assoc($this->_result);
        return false;
    }

    public function getValue($query) {
        $this->getDebug($query);
        $this->_result = false;
        if ($this->_link AND $this->_result = mysqli_query($this->_link, $query . ' LIMIT 1') AND is_array($tmpArray = mysqli_fetch_assoc($this->_result)))
            return array_shift($tmpArray);
        return false;
    }

    public function Execute($query) {
        $this->getDebug($query);
        $this->_result = false;
        if ($this->_link) {
            $this->_result = mysqli_query($this->_link, $query);
            return $this->_result;
        }
        return false;
    }

    public function ExecuteS($query, $array = true) {
        $this->getDebug($query);

        $this->_result = false;
        if ($this->_link && $this->_result = mysqli_query($this->_link, $query)) {
            if (!$array)
                return $this->_result;

            $resultArray = array();
            while ($row = mysqli_fetch_assoc($this->_result))
                $resultArray[] = $row;
            return $resultArray;
        }
        return false;
    }

    public function nextRow($result = false) {
        return mysqli_fetch_assoc($result ? $result : $this->_result);
    }

    public function delete($table, $where = false, $limit = false) {
        $this->_result = false;
        if ($this->_link)
            return mysqli_query($this->_link, 'DELETE FROM `' . pSQL($table) . '`' . ($where ? ' WHERE ' . $where : '') . ($limit ? ' LIMIT ' . intval($limit) : ''));
        return false;
    }

    public function NumRows() {
        if ($this->_link AND $this->_result)
            return mysqli_num_rows($this->_result);
    }

    public function Insert_ID() {
        if ($this->_link)
            return mysqli_insert_id($this->_link);
        return false;
    }

    public function Affected_Rows() {
        if ($this->_link)
            return mysqli_affected_rows($this->_link);
        return false;
    }

    protected function q($query) {
        $this->_result = false;
        if ($this->_link)
            return mysqli_query($this->_link, $query);
        return false;
    }

    /**
     * Returns the text of the error message from previous MySQL operation
     *
     * @acces public
     * @return string error
     */
    public function getMsgError() {
        return mysqli_error();
    }

    public function getNumberError() {
        return mysqli_errno();
    }

    static public function tryToConnect($server, $user, $pwd, $db) {
        if (!$link = @mysqli_connect($server, $user, $pwd))
            return 1;
        if (!@mysqli_select_db($db, $link))
            return 2;
        return 0;
    }

    public function getLink() {
        return $this->_link;
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
	public function	autoExecute($table, $values, $type, $where = false, $limit = false)
	{
		
		if (!sizeof($values))
			return true;

		if (strtoupper($type) == 'INSERT')
		{
			$query = 'INSERT INTO `'.$table.'` (';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'`,';
			$query = rtrim($query, ',').') VALUES (';

			foreach ($values AS $key => $value)
				$query .= '\''.mysqli_real_escape_string($this->_link ,$value).'\',';

			$query = rtrim( $query , ',').')';
			if ($limit)
				$query .= ' LIMIT '.intval($limit);
		
			$this->getDebug($query);
                        // echo $query.'<br />';
			return $this->q($query);
		}
		elseif (strtoupper($type) == 'UPDATE')
		{
			$query = 'UPDATE `'.$table.'` SET ';
			foreach ($values AS $key => $value)
				$query .= '`'.$key.'` = \''.mysqli_real_escape_string($this->_link ,$value).'\',';
			$query = rtrim($query, ',');
			if ($where)
				$query .= ' WHERE '.$where;
			if ($limit)
				$query .= ' LIMIT '.intval($limit);
			$this->getDebug($query);
                       // echo $query.'<br />';
			return $this->q($query); 
		}

		return false;
	}

}