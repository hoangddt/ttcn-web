<?php
require_once '../models/DBConnection.php';
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

    public function details($id)
    {
        $query = $this->conn->query("select books.id id, books.name name, books.author author, books.description description, 
        categories.name category, books.created_at created_at, books.amount amount, books.cost cost
        , books.updated_at updated_at, books.category_id category_id, books.details details 
        from $this->table books, $this->table_ref categories where books.category_id = categories.id AND books.id=$id");
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result;
    }

    public function getLastedBooks($amount) {
        $result = $this->conn->query("call getLastedBooks($amount)");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            if($row['avatar'] === NULL || $row['avatar'] ==="") {
                $row['avatar'] = "/bootcamp/basic/hiennhan/resource/image/default.png";
            }
            $rows[] = $row;
        }
        return $rows;
    }


    public function getNextBook($id) {
        $query = $this->conn->query("call getNextBook($id)");
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result;
    }

    public function getPrevBook($id) {
        $query = $this->conn->query("call getPrevBook($id)");
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result;
    }

    public function getRelatedBook($categoryId, $amount) {
        $result = $this->conn->query("call getRelatedBooks($categoryId, $amount)");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            if($row['avatar'] === NULL || $row['avatar'] ==="") {
                $row['avatar'] = "/bootcamp/basic/hiennhan/resource/image/default.png";
            }
            $rows[] = $row;
        }
        return $rows;
    }

    public function getPosts($categoryId, $amount, $offset) {
        $result = $this->conn->query("call getPosts($categoryId, $amount, $offset)");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            if($row['avatar'] === NULL || $row['avatar'] ==="") {
                $row['avatar'] = "/bootcamp/basic/hiennhan/resource/image/default.png";
            }
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAmountOfBooks($categoryId) {
        $query = $this->conn->query("select count(id) count from $this->table WHERE category_id = $categoryId");
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        return $result['count'];
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}