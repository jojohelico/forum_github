<?php

require_once '../app/models/Article.php';
require_once '../app/models/Rubrique.php';
require_once '../app/models/User.php';
require_once 'BaseController.php';

class RubriqueController extends BaseController {

    public function show() {

        $idRub = $_GET['rub'];
        $rubriqueModel = new Rubrique($this->pdo);
        $articleModel = new Article($this->pdo);
        $userModel = new User($this->pdo);

        $rubrique = $rubriqueModel->getById($idRub);
        $articles = $articleModel->getByRubrique($idRub);

        // For each article, get user and number of replies
        foreach ($articles as &$article) {
            $user = $userModel->getUserById($article['idMemb']);
            $article['prenomMemb'] = $user['prenomMemb'];
            $article['typeMemb'] = $user['typeMemb'];
            $article['nbMessages'] = $articleModel->getNbMessages($article['idArt']);
        }
        // Sans quoi la boucle ne fonctionne pas
        unset($article); 

        require '../app/views/rubrique.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Art'], $_POST['contenuArt'], $_SESSION['idMemb'], $_GET['Rub'])) {
            $articleModel = new Article($this->pdo);
            $articleModel->create($_POST['Art'], $_POST['contenuArt'], $_SESSION['idMemb'], $_GET['Rub']);
        }
        header('Location: ' . base_url('/rubrique/show?rub=' . $_GET['Rub']));
        exit;
    }

    public function supprimer() {
        if (!isset($_SESSION['type']) || $_SESSION['type'] == 2) {
            header('Location: index.php'); exit;
        }

        if (isset($_GET['Article'], $_GET['Rub'])) {
            $articleModel = new Article($this->pdo);
            $articleModel->delete($_GET['Article']);
            header('Location: ' . base_url('/rubrique/show?rub=' . $_GET['Rub']));
            exit;
        }
    }

}
    