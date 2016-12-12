<?php
require_once '../database/DBConnection.php';

/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:07
 */
class Categories
{
    public $table = 'categories';
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function getAll()
    {
        $result = $this->conn->query("select * from $this->table ");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function create($name, $description = "")
    {
            $dateNow = date("Y-m-d H:i:s");
            $result = $this->conn->query("insert into $this->table (name, description, created_at, updated_at) values 
                            ('$name', '$description', '$dateNow', '$dateNow')");
            if($result) {
                return $error['error'] = "$name was not created";
            }
            return;
    }

    public function detail($id)
    {
        $result = array();
        $query = $this->conn->query("select * from $this->table where id=$id");
        if (mysqli_num_rows($query) == 0) {
            $result['error'] = "not existed";
        } else {
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        }
        return $result;
    }

    public function update($id, $name, $description)
    {
        $result = array();
        if (mysqli_num_rows($this->conn->query("select count(id) from $this->table where id=$id")) != 0) {
            $dateNow = date("Y-m-d H:i:s");
            $query = $this->conn->query("update $this->table set name='$name', description='$description', updated_at = '$dateNow' where id=$id");
            if ($query)
                $result['success'] = "$name was updated";
            else
                $result['error'] = "$name was not updated";
        } else {
            $result['error'] = "Id is not existed";
        }
        return $result;
    }

    public function delete($id) {
        $result = array();
        $query = $this->conn->query("select name from $this->table where id=$id");
        if(mysqli_num_rows($query)!=0) {
            $name = mysqli_fetch_row($query)[0];
            $query = $this->conn->query("delete from $this->table WHERE id=$id");
            if ($query)
                $result['success'] = "$name was removed";
            else
                $result['error'] = "$name was not removed";
        }
        else {
            $result['error'] = "This category was not exited";
        }
        return $result;
    }

    public function getCategories() {
        $result = $this->conn->query("select id, name from $this->table ");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}