<?php
require_once '../database/DBConnection.php';

class User
{
    private $salt = "hiennhan";
    public $table = 'user';
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function checkLoginWithSession($authKey) {
        $result = $this->conn->query("select id from $this->table where auth_key = '$authKey'");
        return (mysqli_fetch_row($result)!=0)? true : false;
    }

    public function autoLogin($authKey) {
        $result = $this->conn->query("select id, username from $this->table where auth_key = '$authKey'");
        if(mysqli_num_rows($result)!=0) {
            $_SESSION['auth_key'] = $authKey;
            $_SESSION['hn_username'] = mysqli_fetch_array($result)[username];
            $_SESSION['hn_id'] = mysqli_fetch_array($result)[id];
            return true;
        }
        return false;
    }

    public function login($username, $password, $remember = 0)
    {
        $errors = array();
        //$password_hash = crypt($password, $this->salt);
        $password_hash = md5($password);
        //query username and password
        $result = $this->conn->query("select u.id id, u.username username, l.name level 
        from $this->table u, levels l 
        where username='$username' and password_hash='$password_hash' and u.level=l.id");
        if (mysqli_num_rows($result) == 1) {
            $infor = mysqli_fetch_array($result);
            //create auth_key
            $auth_key = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
            mysqli_fetch_array($result)[id];
            $query =  $this->conn->query("update $this->table set auth_key='$auth_key' where id=$infor[id]");
            //session and cookie
            if ($query) {
                $_SESSION['auth_key'] = $auth_key;
                $_SESSION['hn_username'] = $infor[username];
                $_SESSION['hn_id'] = $infor[id];
                $_SESSION['hn_level'] = $infor[level];
                if ($remember) {
                    if(isset($_COOKIE['auth_key']))
                        setcookie('auth_key', "", -1);
                    setcookie('auth_key', $auth_key, time()+3600 * 24 * 30, "/");
                }
            }
            else
                $errors['error'] = "Request failed!";
            return $errors;
        }
        $errors['error'] = "Email or password was invalid";
        return $errors;
    }

    public function register($email, $username, $password, $passwordConfirm)
    {
        $errors = array();
        if ($password !== $passwordConfirm) {
            $errors['password-confirm'] = "Password is not confirmed";
        } else if (mysqli_num_rows($this->conn->query("select id from $this->table where email='$email'"))) {
            $errors['email'] = "Email is existed";
        } else if (mysqli_num_rows($this->conn->query("select id from $this->table where username='$username'"))) {
            $errors['username'] = "Username is existed";
        } else {
            $password_hash = md5($password);
            $dateNow = date("Y-m-d H:i:s");
            $this->conn->query("insert into $this->table (email, username, password_hash, created_at, updated_at) values 
            ('$email', '$username', '$password_hash', '$dateNow', '$dateNow')");
            return;
        }
        $errors['error'] = true;
        return $errors;
    }

    public function logOut() {
        unset($_COOKIE['auth_key']);
        setcookie('auth_key', null, time()-999, "/");
        $_SESSION['auth_key'] = '';
        session_destroy();
    }

    public function profile($authKey) {
        $result = $this->conn->query("call getProfile('$authKey')");
        return mysqli_fetch_array($result);
    }

    public function update($authKey, $email, $phone, $dob, $address, $description) {
        $this->conn->query("call editProfile('$authKey', '$email', '$phone', '$address', '$description', '$dob')");
    }

    public function changePassword($authKey, $oldPass, $newPass) {
        $query = $this->conn->query("select changePassword('$authKey', '$oldPass', '$newPass') result");
        return (mysqli_fetch_array($query)['result'])? true : false;
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 23/11/2016
 * Time: 21:00
 */
