<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:03
 */
require_once 'AuthController.php';
require_once '../Bean/View.php';
require_once '../models/Categories.php';
if (isset($_GET['func_name'])) {
    $categoryController = new CategoriesController();
    switch ($_GET['func_name']) {
        case 'create':
            $categoryController->actionCreate();
            break;
        case 'index':
            $categoryController->actionIndex();
            break;
        case 'detail':
            $categoryController->actionDetail();
            break;
        case 'update':
            $categoryController->actionUpdate();
            break;
        case 'delete':
            $categoryController->actionDelete();
            break;
    }
}?>
<?php
class CategoriesController {
    public function __construct()
    {
        $auth = new AuthController();
        $auth->auth();
    }

    public function actionIndex() {

        $view = new View('categories/index');
        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);
    }

    public function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = array();
            if(!isset($_POST['name']) || $_POST['name']==="") {
                $errors['name'] = "Name is required";
            }
            else {
                $categories = new Categories();
                $result = $categories->create($_POST['name'], $_POST['description']);
                if(isset($result['error']) || $result['error']==="") {
                    $errors = $result;
                }
                else {
                    $errors['success'] = "$_POST[name] was create success";
                }
            }
            $view = new View('categories/create');
            $view->assign('errors', $errors);
        }
        else new View('categories/create');
    }

    public function actionDetail() {
        $result = array();
        if(isset($_POST['id']) && $_POST['id'] !== "") {
            $categories = new Categories();
            $result = $categories->detail($_POST['id']);
        }
        else {
            $result['error'] = " was empty";
        }
        echo json_encode($result);
    }

    public function actionUpdate() {
        $errors = array();
        if(!isset($_POST['name']) || $_POST['name']==="") {
            $errors['error'] = "Name is required";
        }
        else {
            $categories = new Categories();
            $result = $categories->update($_POST['id'], $_POST['name'], $_POST['description']);
            if(!$result) $errors['error'] = "$_POST[name] was not updated";
                else $errors['success'] = "$_POST[name] was updated";
        }
        $view = new View('categories/index');
        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);
        $view->assign('errors', $errors);
    }

    public function actionDelete() {
        $errors = array();
        $categories = new Categories();
        $result = $categories->delete($_POST['id']);
        if(!$result)
            $errors['error'] = "$_POST[id] was not deleted";
        else
            $errors['success'] = "$_POST[id] was deleted";

        $view = new View('categories/index');
        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);
        $view->assign('errors', $errors);
    }
}
?>