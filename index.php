<?php
require_once 'controllers/ArticleController.php';
$controller = new ArticleController();
$action = isset($_GET['action']) ? $_GET['action'] : 'liste';
if ($action === 'detail' && isset($_GET['id'])) {
    $controller->detail($_GET['id']);
} else {
    $controller->liste();
}
?>