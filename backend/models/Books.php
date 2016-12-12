<?php
require_once '../database/DBConnection.php';
require_once '../models/Categories.php';

/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:07
 */
class Books
{
    public $table = 'books';
    public $table_ref = 'categories';
    public $category_id = 'category_id';
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function getAll()
    {
        $result = $this->conn->query("select books.id id, books.name name, books.author author, books.description description, categories.name category, books.created_at created_at 
        from $this->table books, $this->table_ref categories where books.category_id = categories.id");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function create($name, $author = "", $amount = 0, $amount_rent = 0, $cost = 0, $category_id = 1, $description, $details)
    {
        $first = substr($details, strpos($details, "src=\"") + 5, strlen($details));
        $avatar = substr($first, 0, strpos($first, "\" "));
        $error = array();
        $dateNow = date("Y-m-d H:i:s");

        $result = $this->conn->query("insert into $this->table 
                            (name, author, amount, cost, category_id, description, details, created_at, updated_at, avatar) 
                    values  ('$name', '$author', $amount, $cost, $category_id, '$description', '$details', '$dateNow', '$dateNow', '$avatar')");

        if (!$result) {
            return $error['error'] = "$name was not created";
        }
        return;
    }

    public function details($id)
    {

        $result = array();
        $query = $this->conn->query("select books.id id, books.name name, books.author author, books.description description, 
        categories.name category, books.created_at created_at, books.amount amount, books.amount_rent amount_rent, books.cost cost
        , books.updated_at updated_at, books.category_id category_id, books.details details 
        from $this->table books, $this->table_ref categories where books.category_id = categories.id AND books.id=$id");
        if (mysqli_num_rows($query) == 0) {
            $result['error'] = "not existed";
        } else {
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        }
        return $result;
    }

    public function update($id, $name, $author, $amount, $cost, $category_id, $description, $details)
    {
        $first = substr($details, strpos($details, "src=\"") + 5, strlen($details));
        $avatar = substr($first, 0, strpos($first, "\" "));
        $result = array();
        if (mysqli_num_rows($this->conn->query("select count(id) from $this->table where id=$id")) != 0) {
            $dateNow = date("Y-m-d H:i:s");
            $query = $this->conn->query("update $this->table set name='$name', author='$author'
                , amount = $amount, cost = $cost, category_id = $category_id, details = '$details'
                ,description='$description', updated_at = '$dateNow', avatar = '$avatar' where id=$id");
            if ($query)
                $result['success'] = "$name was updated";
            else
                $result['error'] = "$name was not updated";
        } else {
            $result['error'] = "Id is not existed";
        }
        return $result;
    }

    public function delete($id)
    {
        $result = array();
        $query = $this->conn->query("select name from $this->table where id=$id");
        if (mysqli_num_rows($query) != 0) {
            $name = mysqli_fetch_row($query)[0];
            $query = $this->conn->query("delete from $this->table WHERE id=$id");
            if ($query)
                $result['success'] = "$name was removed";
            else
                $result['error'] = "$name was not removed";
        } else {
            $result['error'] = "This category was not exited";
        }
        return $result;
    }

    public function getLastedBooks($amount)
    {
        $result = array();
        $query = $this->conn->query("call getLastedBooks($amount)");
        $query = mysqli_num_rows($query);
        var_dump($query);
        exit();
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}