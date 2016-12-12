<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 08/12/2016
 * Time: 10:37
 */
require_once 'DBConnection.php';

class SeekingUser
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
        $this->seekingUser();
    }

    private function seekingUser()
    {
        $result = $this->conn->query("
        insert 
        into 
        user(username, password_hash, email, phone, dob, address, description, level, created_at, updated_at)
             values('admin', md5('admin'), 'ngoducnhan2306@gmail.com', '01205678969',now() ,'Danang city', 'I am Ngo Duc Nhan', 1, now(), now())");
        if($result)
            echo "-----------------User's values was inserted----------------\n";
        else
            echo "WARNING: User's values was not inserted----------------\n";
    }
}
$seekingUser = new SeekingUser();