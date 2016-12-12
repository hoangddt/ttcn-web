<?php

/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 23/11/2016
 * Time: 20:48
 */

require_once '../../backend/database/Config.php';
class DBConnection{
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "hiennhantest";

    public function getConnection() {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        if (!$conn) {
            return null;
        }
        return $conn;
    }


}