<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 2/26/19
 * Time: 22:38
 */
require 'SomeDb.php';

class Db extends SomeDb
{
    private $_connection;
    private static $_instance;
    private $_host = "localhost";
    private $_username = "root";
    private $_password = "root";
    private $_database = "test";
    private $result = array();


    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        try {
            $this->_connection = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->_connection;
    }

    public function __destruct()
    {
        $this->_connection = null;
    }


    private function tableExists($table)
    {
        $db = $this->getConnection();
        $tablesInDb = $db->query('SHOW TABLES FROM ' . $this->_database . ' LIKE "' . $table . '"');
        if ($tablesInDb) {
            return true;
        } else {
            return false;
        }
    }

    public function select($table, $rows = '*', $where = null, $order = null, $add = null)
    {
        $db = $this->getConnection();
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($add != null)
            $q .= $add;
        if ($where != null)
            $q .= ' WHERE ' . $where;
        if ($order != null)
            $q .= ' ORDER BY ' . $order;

        if ($this->tableExists($table)) {

            $result = $db->query($q);
            // var_dump($result);die;
            if ($result) {
                return $result->fetchAll();
            } else {
                return false;
            }
        } else
            return false;
    }

    public function delete($table, $where = null, $add = null, $table2 = null)
    {

        $db = $this->getConnection();
        if ($this->tableExists($table)) {
            if ($where == null) {
                $delete = 'DELETE ' . $table;
            } elseif ($add != null) {
                $delete = 'DELETE  ' . $table . ' , ' . $table2 . ' FROM ' . $table . $add . ' WHERE ' . $where;
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
            }
            $del = $db->query($delete);
            if ($del) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function insert($table, $values, $rows = null)
    {
        $db = $this->getConnection();
        if ($this->tableExists($table)) {
            $insert = 'INSERT INTO ' . $table;
            if ($rows != null && count($rows) > 1) {
                $insert .= ' (' . $rows[0] . ',' . $rows[1] . ',' . $rows[2] . ')';
            } else {
                $insert .= ' (' . $rows . ') ';

            }
            for ($i = 0; $i < count($values); $i++) {
                if (is_string($values[$i]))
                    $values[$i] = '"' . $values[$i] . '"';
            }
            $values = implode(',', $values);
            $insert .= ' VALUES (' . $values . ')';
            $ins = $db->query($insert);
            if ($ins) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function update($table, $table2 = null, $rows, $where, $condition, $add = null)
    {
        $db = $this->getConnection();
        if ($this->tableExists($table)) {
            for ($i = 0; $i < count($where); $i++) {
                if ($i % 2 != 0) {
                    if (is_string($where[$i])) {
                        if (($i + 1) != null)
                            $where[$i] = '"' . $where[$i] . '" AND ';
                        else
                            $where[$i] = '"' . $where[$i] . '"';
                    }
                }
            }
            //$where = implode($condition,$where);
            $update = 'UPDATE  ' . $table . ' ' . $add . ' SET ';
            $keys = array_keys($rows);
            for ($i = 0; $i < count($rows); $i++) {
                if (is_string($rows[$keys[$i]])) {
                    $update .= $keys[$i] . ' = "' . $rows[$keys[$i]] . '"';
                } else {
                    $update .= $keys[$i] . ' = ' . $rows[$keys[$i]];
                }
                // Parse to add commas
                if ($i != count($rows) - 1) {
                    $update .= ', ';
                }
            }
            $update .= ' WHERE ' . $where;

            $query = $db->query($update);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}