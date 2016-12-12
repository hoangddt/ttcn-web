<?php
require_once '../models/DBConnection.php';

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
        $result = $this->conn->query("select id, name, description from $this->table");
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
?>