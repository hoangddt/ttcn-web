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
    $postsController = new PostsController();
    switch ($_GET['func_name']) {
        case 'post':
            $postsController->getPost($_GET['id']);
            break;
        case 'nextPost':
            $postsController->getNextPost($_GET['id']);
            break;
        case 'prevPost':
            $postsController->getNextPost($_GET['id']);
            break;
        case 'posts':
            $postsController->getPosts($_GET['id'], (isset($_GET['page'])||$_GET['offset']==="")? $_GET['page'] : 1);
            break;
        case 'delete':
            $bookController->actionDelete();
            break;
    }
}
?>
<?php class PostsController {
    public $pagAmount = 2;
    public function getPosts($categoryId, $offset = 1) {
        if($offset==="") $offset=1;
        $view = new View('home/posts');

        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);

        $book = new Books();
        $result = $book->getPosts($categoryId, $this->pagAmount, $offset);
        $view->assign('posts', $result);

        $book = new Books();
        $paginationResult = $book->getAmountOfBooks($categoryId);
        $paginations = array();
        $paginations['amount'] = ($paginationResult/$this->pagAmount);
        $paginations['offset'] = $offset;
        $view->assign('paginations', $paginations);
    }

    public function getPost($id) {
        $view = new View('home/post-single');

        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);


        $book = new Books();
        $result = $book->details($id);
        $relatedBooks = $book->getRelatedBook($result['category_id'], 2);
        $view->assign('relatedBooks', $relatedBooks);
        $view->assign('post', $result);
    }

    public function getNextPost($id) {
        $view = new View('home/post-single');

        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);


        $book = new Books();
        $result = $book->getNextBook($id);
        $view->assign('post', $result);
    }

    public function getPrevPost($id) {
        $view = new View('home/post-single');

        $categories = new Categories();
        $result = $categories->getAll();
        $view->assign('categories', $result);


        $book = new Books();
        $result = $book->getPrevBook($id);
        $relatedBooks = $book->getRelatedBook($result['category_id'], 2);
        $view->assign('relatedBooks', $relatedBooks);
        $view->assign('post', $result);
    }
}
?>