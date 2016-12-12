<?php
require_once '../database/DBConnection.php';

/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:07
 */
class Users
{
    public $table = 'users';
    public $table_ref = 'levels';
    public $category_id = 'category_id';
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function getAll()
    {
        $result = $this->conn->query("call getUsers('$_SESSION[auth_key]')");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllLevels($authKey) {
        $result = $this->conn->query("call getAllLevels('$authKey')");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function create($authKey, $level=0, $username, $email, $phone, $dob, $address, $description)
    {
        $result = $this->conn->query("select createUser('$authKey', $level, '$username', '$email', 
                                    '$phone', '$dob', '$address', '$description') result");
        return (mysqli_fetch_array($result)['result'])? true : false;
    }

    public function detail($id)
    {
        $result = array();
        $query = $this->conn->query("call getUserDetail('$_SESSION[auth_key]', $id)");
        if (mysqli_num_rows($query) == 0) {
            $result['error'] = "not existed";
        } else {
            while ($row = $query->fetch_assoc()) {
                $result = $row;
            }
        }
        return $result;
    }

    public function getUserConfirm($authKey, $username) {
        $result = $this->conn->query("call getUserConfirm('$authKey', '$username')");
        return $result;
    }

    public function update($id, $authKey, $password='', $email, $phone, $dob, $address, $decription, $level, $username)
    {

        $result = array();
        $query = $this->conn->query("select editUser('$authKey', '$password', '$email', '$phone', '$dob', '$address', '$decription', '$level', '$id') result");

        if(mysqli_fetch_array($query)['result'])
            $result['success'] = "$username was edited";
        else
            $result['error'] = "$username was not edited";
        return $result;
    }

    public function delete($authKey, $id)
    {
        $result = array();
        $query = $this->conn->query("select deleteUser('$authKey', $id) result");
        if(mysqli_fetch_array($query)['result'])
            $result['success'] = "$id was removed";
        else
            $result['error'] = "$id was not removed";
        return $result;
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}