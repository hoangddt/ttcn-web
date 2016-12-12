<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 08/12/2016
 * Time: 10:37
 */
require_once 'DBConnection.php';

class SeekingLevels
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
        $this->seekingLevels();
    }

    private function seekingLevels()
    {
        $result = $this->conn->query("
        insert into levels(id, name, created_at, updated_at)
            values
                (0, 'Member', now(), now()),
            (1, 'Super Admin', now(), now()),
            (2, 'Admin', now(), now()),
            (3, 'Editor', now(), now())");
        if ($result)
            echo "-----------------levels's values was inserted----------------\n";
        else
            echo "WARNING: levels's values was not inserted----------------\n";
    }
}

$seekingLevels = new SeekingLevels();