<?php
require_once 'models/Article.php';

class ArticleController {
    private $model;

    public function __construct() {
        $this->model = new Article();
    }

    public function liste() {
        $cat_id     = isset($_GET['categorie']) ? $_GET['categorie'] : null;
        $articles   = $this->model->getTous($cat_id);
        $categories = $this->model->getCategories();
        require_once 'views/liste.php';
    }

    public function detail($id) {
        $article = $this->model->getParId($id);
        if (!$article) {
            header("Location: index.php");
            exit;
        }
        require_once 'views/detail.php';
    }
}
?>