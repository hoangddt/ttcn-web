<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 23/11/2016
 * Time: 21:39
 */
require_once '../models/User.php';
require_once '../Bean/View.php';
if (isset($_GET['func_name'])) {
    $authController = new AuthController();
    switch ($_GET['func_name']) {
        case 'login':
            $authController->actionLogin();
            break;
        case 'register':
            $authController->actionRegister();
            break;
        case 'logout':
            $authController->actionLogout();
            break;
        case 'profile':
            $authController->actionProfile();
            break;
        case 'changePassword':
            $authController->actionChangePassword();
            break;
    }
}
?>
<?php

class AuthController
{
    public function __construct()
    {
        session_start();
    }

    public function auth()
    {
        if (!isset($_SESSION['auth_key']) || $_SESSION['auth_key'] === "" || !isset($_SESSION['hn_username'])) {
            if (isset($_COOKIE["auth_key"])) {
                $user = new User();
                if (!$user->autoLogin($_COOKIE['auth_key'])) {
                    header('Location: ../controllers/AuthController.php?func_name=login');
                }
            } else {
                header('Location: ../controllers/AuthController.php?func_name=login');
            }
        } else {
            $user = new User();
            if (!$user->checkLoginWithSession($_SESSION['auth_key']))
                header('Location: ../controllers/AuthController.php?func_name=login');
        }
    }

    public function actionLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            new View('user/login');
        } else {
            if (isset($_POST['username']) && $_POST['username'] === "")
                $errors['username'] = "Username is required";
            else if (isset($_POST['password']) && $_POST['password'] === "")
                $errors['password'] = "Password is required";
            else {
                $user = new User();
                $errors = $user->login($_POST['username'], $_POST['password'], ($_POST['remember'] == "1") ? 1 : 0);
                if (!isset($errors['error']) || $errors['error'] === "") {
                    header('Location: ../controllers/CategoriesController.php?func_name=index');
                    return;
                }
            }
            $view = new View('user/login');
            $view->assign('errors', $errors);
        }
    }

    public function actionRegister()
    {
        $errors = array();
        if ($_POST['email'] === "") {
            $errors['email'] = "Email is required";
        } else if ($_POST['username'] === "") {
            $errors['username'] = "Username is required";
        } else if ($_POST['password'] === "") {
            $errors['password'] = "Password is required";
        } else if ($_POST['password-confirm'] === "") {
            $errors['password-confirm'] = "Password confirm is required";
        } else {
            $user = new User();
            $errors = $user->register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password-confirm']);
            if (!$errors['error']) {
                header('Location: ../views/');
                return;
            }
        }
        $errors['email-value'] = $_POST['email'];
        $errors['username-value'] = $_POST['username'];
        $errors['password-value'] = $_POST['password'];
        $errors['password-confirm-value'] = $_POST['password-confirm'];
        $this->postErrors($errors);
        header('Location: ../views/user/register.php');
    }

    public function actionLogout()
    {
        $user = new User();
        $user->logOut();
        header('Location: ../controllers/AuthController.php?func_name=login');
    }

    private function postErrors($errors)
    {
        $_SESSION['errors'] = $errors;
    }

    public function actionProfile()
    {
        $this->auth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $user = new User();
            $result = $user->profile($_SESSION['auth_key']);
            $view = new View("user/profile");
            $view->assign('user', $result);
        } else {
            $errors = array();
            if (!isset($_POST['email']) or $_POST['email'] === "") {
                $errors['error'] = "Email is required";
                $user = new User();
                $result = $user->profile($_SESSION['auth_key']);
                $view = new View("user/profile");
                $view->assign('user', $result);
                $view->assign('errors', $errors);
            } else {
                $user = new User();
                $user->update($_SESSION['auth_key'], $_POST['email'],
                    $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['description']);
                header('Location: ../controllers/AuthController.php?func_name=profile');
            }
        }
    }

    public function actionChangePassword()
    {
        $view = new View("user/change-password");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = array();
            if (!isset($_POST['old-password']) or $_POST['old-password'] === ""
                or !isset($_POST['new-password']) or $_POST['new-password'] === ""
                or !isset($_POST['confirm-password']) or $_POST['confirm-password'] === ""
            )
                $errors['error'] = 'Each field is required';
            else {
                if ($_POST['new-password'] !== $_POST['confirm-password'])
                    $errors['error'] = "Password not match";
                else {
                    $user = new User();
                    $result = $user->changePassword($_SESSION['auth_key'], $_POST['old-password'], $_POST['new-password']);
                    if ($result)
                        $errors['success'] = "Password was changed";
                    else
                        $errors['error'] = "Password was not changed";
                }
            }
            $view->assign('errors', $errors);
        }

    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}

?>
