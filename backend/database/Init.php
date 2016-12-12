<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 08/12/2016
 * Time: 09:59
 */
require_once 'DBConnection.php';

class Init
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
        $this->createTableUser();
        $this->createTableCategories();
        $this->createTableBooks();
        $this->createTableLevels();
        $this->createGetLastedBooksProcedure();
        $this->createEditProfileProcedure();
        $this->createGetAllLevelsProcedure();
        $this->createGetNextBookProcedure();
        $this->createGetPostsProcedure();
        $this->createGetPrevBookProcedure();
        $this->createGetProfileProcedure();
        $this->createGetRelatedBooksProcedure();
        $this->createGetUserConfirmProcedure();
        $this->createGetUserDetailProcedure();
        $this->createGetUsersProcedure();
        $this->createChangePasswordFunction();
        $this->createCreateUserFunction();
        $this->createDeleteUserFunction();
        $this->createEditUserFunction();
    }

    private function createTableUser()
    {
        $result = $this->conn->query("create table user(id integer primary key auto_increment, username varchar(30) unique, auth_key varchar(100), 
                 password_hash varchar(100) not null, email varchar(100) not null, phone varchar(20),
                 dob date, address varchar(100), description text, level int not null default 0, created_at datetime not null,
                 updated_at datetime not null)");
        if ($result)
            echo "-----------------Table 'user' was created----------------\n";
        else
            echo "WARNING: Table 'user' was not created----------------\n";
    }

    private function createTableCategories()
    {
        $result = $this->conn->query("create table categories(
            id integer primary key auto_increment,
            name varchar(100) not null unique,
            description text,
            created_at datetime not null,
            updated_at datetime not null)");
        if ($result)
            echo "-----------------Table 'categories' was created----------------\n";
        else
            echo "WARNING: Table 'categories' was not created----------------\n";
    }

    private function createTableBooks()
    {
        $result = $this->conn->query("create table books(
        id integer primary key auto_increment,
        category_id integer not null,
        name varchar(100) not null,
        author varchar(100) not null,
        description text,
        details text,
        avatar text,
        amount integer default 0,
        cost integer default 0,
        created_at datetime not null,
        updated_at datetime not null,
        foreign key (category_id) references categories(id))");
        if ($result)
            echo "-----------------Table 'books' was created----------------\n";
        else
            echo "WARNING: Table 'books' was not created----------------\n";
    }

    private function createTableLevels()
    {
        $result = $this->conn->query("create table levels(
        id integer unique primary key not null,
        name varchar(50) not null unique,
        created_at datetime not null,
        updated_at datetime not null) ENGINE=InnoDB AUTO_INCREMENT=0");
        if ($result)
            echo "-----------------Table 'levels' was created----------------\n";
        else
            echo "WARNING: Table 'levels' was not created----------------\n";

    }

    private function createGetLastedBooksProcedure()
    {
        $result = $this->conn->multi_query("
                CREATE DEFINER=`root`@`localhost` PROCEDURE `getLastedBooks`(IN `amount` INT)
                BEGIN  
                   SELECT id, name, author, description, avatar FROM books
                    order by created_at desc limit amount;  
                END");
        if ($result)
            echo "-----------------Procedure 'getLastedBooks' was created----------------\n";
        else
            echo "WARNING: Procedure 'getLastedBooks' was not created----------------\n";
    }

    private function createEditProfileProcedure()
    {
        $result = $this->conn->multi_query("
                CREATE PROCEDURE `editProfile`(IN `authKey` VARCHAR(70), IN `varEmail` VARCHAR(70), IN `varPhone` VARCHAR(20), IN `varAddress` VARCHAR(100), IN `varDescription` TEXT, IN `varDOB` DATETIME)
                    NO SQL
                begin
                    update user 
                    set email = varEmail, phone = varPhone, address = varAddress,
                    description = varDescription, dob = varDOB, updated_at = now()
                    where auth_key = authKey;
                end");
        if ($result)
            echo "-----------------Procedure 'editProfile' was created----------------\n";
        else
            echo "WARNING: Procedure 'editProfile' was not created----------------\n";
    }

    private function createGetAllLevelsProcedure()
    {
        $result = $this->conn->multi_query("
                CREATE PROCEDURE `getAllLevels`(IN `authKey` VARCHAR(70))
                    NO SQL
                begin
                    declare coreLevel int;
                    set coreLevel = (select level from user where auth_key=authKey);
                    select id, name from levels where id=0 or id>coreLevel;
                end");
        if ($result)
            echo "-----------------Procedure 'getAllLevels' was created----------------\n";
        else
            echo "WARNING: Procedure 'getAllLevels' was not created----------------\n";
    }

    private function createGetNextBookProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getNextBook`(IN `idBook` INT)
                        NO SQL
                        DETERMINISTIC
                    begin
                        declare idNext int;
                        set idNext = (select id from books where id > idBook order by id limit 1);
                        select * from books where id = idNext;
                    end");
        if ($result)
            echo "-----------------Procedure 'getNextBook' was created----------------\n";
        else
            echo "WARNING: Procedure 'getNextBook' was not created----------------\n";
    }

    private function createGetPostsProcedure()
    {
        $result = $this->conn->multi_query("
                CREATE  PROCEDURE `getPosts`(IN `categoryId` INT, IN `amount` INT, IN `offset` INT)
                    NO SQL
                begin
                    declare num int;
                    declare dayLastPost datetime;
                    if offset = 1
                        then
                                select b.id id, b.name name, b.author author, b.description description,
                                b.created_at created_at, b.category_id category_id, c.name category, b.avatar avatar
                                from books b, categories c
                                where b.category_id = categoryId
                                and c.id = b.category_id
                                order by b.created_at desc limit amount;
                        else
                                set offset = offset-1;
                                set num = offset*amount;
                                set dayLastPost = (select created_at from (select created_at from books 
                                where category_id = categoryId
                                order by created_at desc limit num) a order by a.created_at limit 1);
                                select b.id id, b.name name, b.author author, b.description description,
                                b.created_at created_at, b.category_id category_id, c.name category, b.avatar avatar
                                from books b, categories c
                                where b.created_at < dayLastPost and b.category_id = categoryId
                                and c.id = b.category_id;
                                
                    end if;
                    end");
        if ($result)
            echo "-----------------Procedure 'getPosts' was created----------------\n";
        else
            echo "WARNING: Procedure 'getPosts' was not created----------------\n";
    }

    private function createGetPrevBookProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getPrevBook`(IN `idBook` INT)
                        NO SQL
                    begin
                        declare idNext int;
                        set idNext = (select id from books where id < idBook order by id limit 1);
                        select * from books where id = idNext;
                    end");
        if ($result)
            echo "-----------------Procedure 'getPrevBook' was created----------------\n";
        else
            echo "WARNING: Procedure 'getPrevBook' was not created----------------\n";
    }

    private function createGetProfileProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE DEFINER=`root`@`localhost` PROCEDURE `getProfile`(IN `authKey` INT)
                        NO SQL
                    begin
                        select u.id id, u.username, u.email email, u.phone, u.dob dob, u.address
                        address, u.description description, l.name level
                        from user u, levels l  
                        where auth_key = authKey and u.level=l.id;
                    end");
        if ($result)
            echo "-----------------Procedure 'getProfile' was created----------------\n";
        else
            echo "WARNING: Procedure 'getProfile' was not created----------------\n";
    }

    private function createGetRelatedBooksProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getRelatedBooks`(IN `categoryId` INT, IN `amount` INT)
                        NO SQL
                    begin
                        select * from books where category_id = categoryId limit amount;
                    end");
        if ($result)
            echo "-----------------Procedure 'getRelatedBooks' was created----------------\n";
        else
            echo "WARNING: Procedure 'getRelatedBooks' was not created----------------\n";
    }

    private function createGetUserConfirmProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getUserConfirm`(IN `authKey` VARCHAR(70), IN `varUsername` VARCHAR(30))
                        NO SQL
                    begin
                        declare coreLevel int;
                        set coreLevel = (select level from user where auth_key= authKey);
                        select username, password_hash password from user where username = varUsername and ((level>coreLevel) or (level=0));
                    end");
        if ($result)
            echo "-----------------Procedure 'getUserConfirm' was created----------------\n";
        else
            echo "WARNING: Procedure 'getUserConfirm' was not created----------------\n";
    }

    private function createGetUserDetailProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getUserDetail`(IN `authKey` VARCHAR(70), IN `findId` INT)
                        NO SQL
                    begin
                        declare coreLevel int;
                        set coreLevel = (select level from user where auth_key=authKey);
                        select u.id id, u.username username, u.email email, u.phone phone, u.dob dob,
                        u.address address, u.description description, u.created_at created_at, u.updated_at updated_at, l.name level
                        from user u, levels l where (u.id=findId) and (coreLevel!=0) and (coreLevel<u.level or u.level=0) and (u.level = l.id);
                    end");
        if ($result)
            echo "-----------------Procedure 'getUserDetail' was created----------------\n";
        else
            echo "WARNING: Procedure 'getUserDetail' was not created----------------\n";
    }

    private function createGetUsersProcedure()
    {
        $result = $this->conn->multi_query("
                    CREATE PROCEDURE `getUsers`(IN `authKey` VARCHAR(70))
                        NO SQL
                    begin
                        declare selectLevel int;
                        set selectLevel = (select level from user where auth_key = authKey);
                        select id, username, email, phone, dob, address, description, created_at, updated_at
                        from user where ((level=0) or (level>selectLevel)) and selectLevel!=0;
                    end");
        if ($result)
            echo "-----------------Procedure 'getUsers' was created----------------\n";
        else
            echo "WARNING: Procedure 'getUsers' was not created----------------\n";
    }

    private function createChangePasswordFunction()
    {
        $result = $this->conn->multi_query("
                    CREATE FUNCTION `changePassword`(`authKey` VARCHAR(70), `oldPass` VARCHAR(100), `newPass` VARCHAR(100)) RETURNS int(1)
                        NO SQL
                    begin
                        declare ch int;
                        set ch = (select count(id) from user
                                  where auth_key = authKey and password_hash = md5(oldPass));
                        if (ch != 0) then
                            update user set password_hash = md5(newPass)
                            where auth_key = authKey;
                            return 1;
                        else
                            return 0;
                        end if;
                    end");
        if ($result)
            echo "-----------------Function 'changePassword' was created----------------\n";
        else
            echo "WARNING: Function 'changePassword' was not created----------------\n";
    }

    private function createCreateUserFunction()
    {
        $result = $this->conn->multi_query("
                    CREATE FUNCTION `createUser`(`authKey` VARCHAR(70), `varLevel` INT UNSIGNED, `varUsername` VARCHAR(30), `varEmail` VARCHAR(70), `varPhone` VARCHAR(20), `varDOB` DATE, `varAddress` VARCHAR(100), `varDescription` TEXT) RETURNS int(1)
                        MODIFIES SQL DATA
                    begin
                    declare coreLevel int;
                    declare same int;
                        set same = (select count(id) from user where username=varUsername or email=varEmail);
                        set coreLevel = (select level from user where auth_key=authKey);
                        if ((varLevel=0) or (coreLevel<varLevel)) and same=0 then
                        insert into user(username, password_hash, email, phone, dob, 
                        address, description, created_at, updated_at)
                        values (varUsername, md5(varUsername), varEmail,
                        varPhone, varDOB, varAddress, varDescription, now(), now());
                        return 1;
                        else
                        return 0;
                        end if;
                    end");
        if ($result)
            echo "-----------------Function 'createUser' was created----------------\n";
        else
            echo "WARNING: Function 'createUser' was not created----------------\n";
    }

    private function createDeleteUserFunction()
    {
        $result = $this->conn->multi_query("
                    CREATE FUNCTION `deleteUser`(`authKey` VARCHAR(70), `varId` INT) RETURNS int(1)
                        NO SQL
                    begin
                        declare coreLevel int;
                        set coreLevel = (select level from user where auth_key = authKey);
                        if (coreLevel > 0) then
                        delete from user where id = varId and ((coreLevel < level) or (level=0));
                        return 1;
                        else return 0;
                        end if;
                    end");
        if ($result)
            echo "-----------------Function 'deleteUser' was created----------------\n";
        else
            echo "WARNING: Function 'deleteUser' was not created----------------\n";
    }

    private function createEditUserFunction()
    {
        $result = $this->conn->multi_query("
                    CREATE FUNCTION `editUser`(`authKey` VARCHAR(70), `varPass` VARCHAR(70), `varEmail` VARCHAR(70), `varPhone` VARCHAR(20), `varDOB` DATETIME, `varAddress` VARCHAR(100), `varDescription` TEXT, `varLevel` INT, `varID` INT) RETURNS int(1)
                        NO SQL
                    begin	
                        declare coreLevel int;
                        set coreLevel = (select level from user where auth_key = authKey);
                        if(coreLevel!=0) then
                        update user set 
                        email = varEmail, phone = varPhone, dob = varDOB, address = varAddress,
                        description = varDescription, level = varLevel, updated_at = now()
                        where (id = varID) and ((varLevel>coreLevel) or (varLevel=0));
                        return 1;
                        else return 0;
                        end if;
                    end");
        if ($result)
            echo "-----------------Function 'editUser' was created----------------\n";
        else
            echo "WARNING: Function 'editUser' was not created----------------\n";
    }

}

$init = new Init();