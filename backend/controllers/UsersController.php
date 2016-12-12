<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:03
 */
require_once 'MailController.php';
require_once 'AuthController.php';
require_once '../models/Users.php';
require_once '../Bean/View.php';
if (isset($_GET['func_name'])) {
    $usersController = new UsersController();
    switch ($_GET['func_name']) {
        case 'create':
            $usersController->actionCreate();
            break;
        case 'index':
            $usersController->actionIndex();
            break;
        case 'detail':
            $usersController->actionDetail();
            break;
        case 'update':
            $usersController->actionUpdate();
            break;
        case 'delete':
            $usersController->actionDelete();
            break;
    }
} ?>
<?php

class UsersController
{
    public function __construct()
    {
        $auth = new AuthController();
        $auth->auth();
    }

    public function actionIndex($error = "")
    {
        $users = new Users();
        $result = $users->getAll();
        $view = new View('users/index');
        //$view = new View('user/login');
        $view->assign('errors', $error);
        $view->assign('users', $result);
        return;
    }

    public function actionCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $view = new View('users/create');
            $users = new Users();
            $levels = $users->getAllLevels($_SESSION['auth_key']);
            $view->assign('levels', $levels);
        } else {
            //o$hey = $_POST['details'];
            //var_dump($_POST[$hey]);
            //exit();
            //show_source("../views/layout/mail-response.php");
            $errors = array();
            if (!isset($_POST['username']) || $_POST['username'] === "")
                $errors['username'] = "Username is required";
            else if (!isset($_POST['email']) || $_POST['email'] == "")
                $errors['email'] = "Email is required";
            else {
                $users = new Users();
                $result = $users->create($_SESSION['auth_key'], $_POST['level'], $_POST['username'], $_POST['email'],
                    $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['description']);
                if ($result) {
                    $errors['success'] = "$_POST[name] was create success, please check email: $_POST[email] to change the password";
                    $users = new Users();
                    $result = $users->getUserConfirm($_SESSION['auth_key'], $_POST['username']);
                    if (mysqli_num_rows($result) != 0) {
                        $result = mysqli_fetch_assoc($result);
                        $mailController = new MailController();
                        $mailController->initMail($_POST['email'], "Congratulation..."
                            , $mailController->mailBodyConfirm($result['username'], $result['username'], getenv('HTTP_HOST') . "/bootcamp/basic/hiennhan/backend/controllers/AuthController.php?func_name=login"));
                        $mailController->send();
                    }
                } else
                    $errors['error'] = "$_POST[name] was not create success";
            }

            $view = new View('users/create');
            $users = new Users();
            $levels = $users->getAllLevels($_SESSION['auth_key']);
            $view->assign('levels', $levels);
            $view->assign('errors', $errors);
        }
        return $view;
    }

    public function actionDetail()
    {
        $result = array();
        if (isset($_POST['id']) && $_POST['id'] !== "") {
            $users = new Users();
            $result = $users->detail($_POST['id']);
            //$categories = new Categories();
            //$result = $categories->detail(1);
        } else {
            $result['error'] = " was empty";
        }
        mb_internal_encoding('UTF-8');
        $result = array_map('utf8_encode', $result);
        echo json_encode($result);
        //result = json_encode($result);
    }

    public function actionUpdate()
    {
        $result = array();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $result['error'] = "Failed!";
        } else {
            if (!isset($_POST['id']) or $_POST['id'] === "")
                $result['error'] = "ID is required!";
            else if (!isset($_POST['email']) or $_POST['email']==="")
                $result['error'] = "Email was required!";
            else {
                $user = new Users();
                $result = $user->update($_POST['id'], $_SESSION['auth_key'], $_POST['password'], $_POST['email'], $_POST['phone'],
                    $_POST['dob'], $_POST['address'], $_POST['description'], $_POST['level'], $_POST['username']);
            }
        }
        $this->actionIndex($result);
    }

    public function actionDelete()
    {
        $users = new Users();
        $result = $users->delete($_SESSION['auth_key'], $_POST['id']);
        $this->actionIndex($result);
    }

}

?>