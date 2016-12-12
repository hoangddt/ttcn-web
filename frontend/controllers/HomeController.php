<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 28/11/2016
 * Time: 15:41
 */

require_once '../models/Categories.php';
require_once '../models/Books.php';
require_once '../Bean/View.php';


if (isset($_GET['func_name'])) {
    $homeController = new HomeController();
    switch ($_GET['func_name']) {
        case 'create':
            $bookController->actionCreate();
            break;
        case 'index':
            $homeController->actionIndex();
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
}

?>
<?php
    class HomeController {
        public function actionIndex() {
            $categories = new Categories();
            $result = $categories->getAll();
            $view = new View('home/index');
            $view->assign('categories', $result);
            $book = new Books();
            $result = $book->getLastedBooks(4);
            $view->assign('lastedBooks', $result);
        }
    }
?>
