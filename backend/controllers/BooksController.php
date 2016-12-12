<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 25/11/2016
 * Time: 13:03
 */
require_once 'AuthController.php';
require_once '../models/Books.php';
require_once '../Bean/View.php';
if (isset($_GET['func_name'])) {
    $bookController = new BooksController();
    switch ($_GET['func_name']) {
        case 'create':
            $bookController->actionCreate();
            break;
        case 'index':
            $bookController->actionIndex();
            break;
        case 'detail':
            $bookController->actionDetail();
            break;
        case 'update':
            $bookController->actionUpdate();
            break;
        case 'delete':
            $bookController->actionDelete();
            break;
    }
}?>
<?php
class BooksController {
    public function __construct()
    {
        $auth = new AuthController();
        $auth->auth();
    }

    public function actionIndex($error="") {
        $books = new Books();
        $result = $books->getAll();
        $view = new View('books/index');
        //$view = new View('user/login');
        $view->assign('errors', $error);
        $view->assign('books', $result);
        return ;
    }

    public function actionCreate() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $view = new View('books/create');
            $categories = new Categories();
            $categories = $categories->getCategories();
            $view->assign('categories', $categories);
        }
        else {
            //o$hey = $_POST['details'];
            //var_dump($_POST[$hey]);
            //exit();
            $errors = array();
            if(!isset($_POST['name']) || $_POST['name']==="")
                $errors['name'] = "Name is required";
            else if (!isset($_POST['author']) || $_POST['author'] == "")
                $errors['author'] = "Author is required";
            else if (!is_numeric($_POST['amount']) || $_POST['amount']<0 || !round($_POST['amount'], 0))
                $errors['amount'] = "Amount is invalid";
            else if (!is_numeric($_POST['cost']) || $_POST['cost']<0 || !round($_POST['cost'], 0))
                $errors['cost'] = "Cost is invalid";
            else {
                $books = new Books();
                $result = $books->create($_POST['name'], $_POST['author'], $_POST['amount'],
                    $_POST['amount_rent'], $_POST['cost'], $_POST['category_id'], $_POST['description'], $_POST['details']);
                if(isset($result['error']) || $result['error']==="") {
                    $errors = $result;
                }
                else {
                    $errors['success'] = "$_POST[name] was create success";
                }
            }
            $view = new View('books/create');
            $view->assign('errors', $errors);
            $categories = new Categories();
            $categories = $categories->getCategories();
            $view->assign('categories', $categories);
        }
        return $view;
    }

    public function actionDetail() {
        $result = array();
        if(isset($_POST['id']) && $_POST['id'] !== "") {
            $books = new Books();
            $result = $books->details($_POST['id']);
        }
        else {
            $result['error'] = " was empty";
        }
        echo json_encode($result);
    }

    public function actionUpdate() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $books = new Books();
            if(isset($_GET['id']) && $_GET['id'] !== "") {
                $result = $books->details($_GET['id']);
                $categories = new Categories();
                $categories = $categories->getCategories();
                $view = new View('books/update');
                $view->assign('book', $result);
                $view->assign('categories', $categories);
            }
        }

        else {
            if(!isset($_POST['name']) || $_POST['name']==="")
                $errors['name'] = "Name is required";
            else if (!isset($_POST['author']) || $_POST['author'] == "")
                $errors['author'] = "Author is required";
            else if (!is_numeric($_POST['amount']) || $_POST['amount']<0 || !round($_POST['amount'], 0))
                $errors['amount'] = "Amount is invalid";
            else if (!is_numeric($_POST['cost']) || $_POST['cost']<0 || !round($_POST['cost'], 0))
                $errors['cost'] = "Cost is invalid";
            else {
                $books = new books();
                $result = $books->update($_POST['id'], $_POST['name'], $_POST['author']
                    , $_POST['amount'], $_POST['cost'], $_POST['category_id'], $_POST['description'], $_POST['details']);
                $book = $books->details($_GET['id']);
                $categories = new Categories();
                $categories = $categories->getCategories();
                $view = new View('books/update');
                $view->assign('book', $book);
                $view->assign('categories', $categories);
                $view->assign('errors', $result);
            }
        }
    }

    public function actionDelete() {
        $books = new Books();
        $result = $books->delete($_POST['id']);
        $this->actionIndex($result);
    }
}
?>