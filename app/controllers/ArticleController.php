<?php

require_once '../app/models/Article.php';
require_once '../app/models/Reponse.php';
require_once '../app/models/User.php';
require_once 'BaseController.php';

class ArticleController extends BaseController {

    public function show() {
        
        $idArt = $_GET['id'];
        $articleModel = new Article($this->pdo);
        $reponseModel = new Reponse($this->pdo);
        $userModel = new User($this->pdo);

        $article = $articleModel->getById($idArt);
        $articleAuthor = $userModel->getUserById($article['idMemb']);
        $article['prenomMemb'] = $articleAuthor['prenomMemb'];
        $article['typeMemb'] = $articleAuthor['typeMemb'];

        $reponses = $reponseModel->getByArticle($idArt);
        foreach ($reponses as &$rep) {
            $repUser = $userModel->getUserById($rep['idMemb']);
            $rep['prenomMemb'] = $repUser['prenomMemb'];
            $rep['typeMemb'] = $repUser['typeMemb'];
        }
        unset($rep);

        require '../app/views/article.php';
    }

    public function createRep() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contenuRep'], $_SESSION['idMemb'], $_GET['id'])) {
            $reponseModel = new Reponse($this->pdo);
            $reponseModel->create($_POST['contenuRep'], $_SESSION['idMemb'], $_GET['id']);
            header('Location: ' . base_url('/article/show?id=' . $_GET['id']));
            exit;
        }
    }

    public function deleteRep() {
        if (!isset($_SESSION['type']) || $_SESSION['type'] == 2) {
            header('Location: ' . base_url('/'));
            exit;
        }
    
        if (isset($_GET['id'], $_GET['article'])) {
            $reponseModel = new Reponse($this->pdo);
            $reponseModel->delete($_GET['id']);
            header('Location: ' . base_url('/article/show?id=' . $_GET['article']));
            exit;
        }
    }
}
