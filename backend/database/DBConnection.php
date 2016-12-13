<?php

/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 23/11/2016
 * Time: 20:48
 */
include_once '/Config.php';

echo SERVER_NAME;

class DBConnection{
    private $servername = SERVER_NAME;
    private $username = USER_NAME;
    private $password = PASSWORD;
    private $database = DATABASE;
    public function getConnection() {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        if (!$conn) {
            echo "TB";
            exit();
            return null;
        }
        return $conn;
    }


}