<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 08/12/2016
 * Time: 10:37
 */
require_once 'DBConnection.php';

class SeekingCategories
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
        $this->seekingCategories();
    }

    private function seekingCategories()
    {
        $result = $this->conn->query("insert into categories (name, description, created_at, updated_at) values ('Hạt giống tâm hồn', 
                          'Những câu chuyện đời cho bạn, cho tôi, cho chúng ta, ...', '2016-12-12', '2016-12-12')");
        if ($result)
            echo "-----------------Categories: 'Hạt giống tâm hồn' was inserted----------------\n";
        else
            echo "WARNING: Categories: 'Hạt giống tâm hồn' was not inserted----------------\n";

        $result = $this->conn->query("insert into categories (name, description, created_at, updated_at) values ('Sách kỹ năng', 
                          'Kỹ năng sống, kỹ năng thuyết trình,...', '2016-12-12', '2016-12-12')");
        if ($result)
            echo "-----------------Categories: 'Sách kỹ năng' was inserted----------------\n";
        else
            echo "WARNING: Categories: 'Sách kỹ năng' was not inserted----------------\n";

        $result = $this->conn->query("insert into categories (name, description, created_at, updated_at) values ('Văn hóa - Nghệ thuật', 
                          'Những ca khúc bất hủ, văn hóa địa phương,...', '2016-12-12', '2016-12-12')");
        if ($result)
            echo "-----------------Categories: 'Văn hóa - Nghệ thuật' was inserted----------------\n";
        else
            echo "WARNING: Categories: 'Văn hóa - Nghệ thuật' was not inserted----------------\n";
    }
}

$seekingCategories = new SeekingCategories();