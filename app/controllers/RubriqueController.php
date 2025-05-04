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
            $articleModel->createArt($_POST['Art'], $_POST['contenuArt'], $_SESSION['idMemb'], $_GET['Rub']);
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
            $articleModel->deleteArt($_GET['Article']);
            header('Location: ' . base_url('/rubrique/show?rub=' . $_GET['Rub']));
            exit;
        }
    }

    public function deleteRub() {
        if (isset($_GET['Rubrique'])) {
            $idRub = intval($_GET['Rubrique']);
            $model = new Rubrique($this->pdo);
            $model->deleteRub($idRub);

            header('Location: ' . base_url('/admin/index'));
            exit();
         }
    }

    public function addRub() {
        if (
            isset($_POST['NomRub'], $_POST['IdCat']) &&
            !empty($_POST['NomRub']) &&
            !empty($_POST['IdCat'])
        ) {
            $nomRub = htmlspecialchars($_POST['NomRub']);
            $idCat = intval($_POST['IdCat']);
            $descRub = htmlspecialchars($_POST['DescRub']) ? htmlspecialchars($_POST['DescRub']) : null;

            $model = new Rubrique($this->pdo);
            $model->createRub($descRub, $idCat, $nomRub);

            header('Location: ' . base_url('/admin/index'));
            exit();
        } else {
            echo "Le titre et la catégorie sont obligatoires.";
        }
    }

    public function modifRub() {
        if (isset($_POST['idRub'], $_POST['NomRub'])) {
            $idRub = intval($_POST['idRub']);
            $nomRub = htmlspecialchars($_POST['NomRub']);
            $descRub = isset($_POST['DescRub']) ? htmlspecialchars($_POST['DescRub']) : null;
    
            $rubriqueModel = new Rubrique($this->pdo);
            $rubriqueModel->modifRub($idRub, $nomRub, $descRub);
    
            header('Location: ' . base_url('/admin/index'));
            exit();
        } else {
            echo "Champs manquants.";
        }
    }
}
    