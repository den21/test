<?php

require 'Db.php';

class Users
{
    protected $id;
    private $name;
    protected $email;
    protected $country_id;
    private $prefix = "t_";


    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getCountry()
    {
        return $this->countries;
    }

    public function setCountry($country)
    {
        $this->countries = $country;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function __construct()
    {
        $this->startDB();
    }

    public function __destruct()
    {
        $this->closeDB();
    }

    public function startDB()
    {

        $db = Db::getInstance();
        $this->_dbh = $db->getConnection();
    }

    public function closeDB()
    {

        $db = Db::getInstance();
        $this->_dbh = $db->__destruct();
    }

    public function getUsers($where = null)
    {

        $prefix = $this->getPrefix();
        $table1 = $prefix . 'users';
        $table2 = $prefix . 'countries';

        try {
            $db = Db::getInstance();
            $param = $db->select($table1, $rows = '*', $where, $order = null, $add = " INNER JOIN $table2 ON $table1.country_id=$table2.id");
            return $param;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->closeDB();
    }


    public function deleteUsers($id)
    {

        $prefix = $this->getPrefix();
        $table1 = $prefix . 'users';
        $table2 = $prefix . 'countries';
        $where = "t_users.id =  $id";

        try {
            $db = Db::getInstance();
            $param = $db->delete($table1, $where, $add = " INNER JOIN $table2   ON $table1.country_id=$table2.id", $table2);
            return $param;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->closeDB();

    }

    public function updateUsers($id)
    {

        $rows = ['t_users.name' => $this->getName(), 't_users.email' => $this->getEmail(), 't_countries.country' => $this->getCountry()];

        $prefix = $this->getPrefix();
        $table1 = $prefix . 'users';
        $table2 = $prefix . 'countries';
        $where = "t_users.id =  $id";
        $conditional = "id = '  $id'";


        try {
            $db = Db::getInstance();
            $param = $db->update($table1, $table2, $rows, $where, $conditional, $add = " INNER JOIN $table2   ON $table1.country_id=$table2.id");
            return $param;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->closeDB();

    }


    public function addUsers()
    {
        $prefix = $this->getPrefix();
        $table1 = $prefix . 'users';
        $table2 = $prefix . 'countries';
        $country = $this->getCountry();
        $where = "country = '$country'";
        $row = ['name', 'email', 'country_id'];
        try {
            $db = Db::getInstance();
            $param1 = $db->insert($table2, array($this->getCountry()), 'country');

            $select_id = $db->select($table2, $rows = '*', $where, $order = null, $add = null);
            $select_id = $select_id[0]['id'];
            $param2 = $db->insert($table1, array($this->getName(), $this->getEmail(), $select_id), $row);

            return $param2;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $this->closeDB();

    }


}