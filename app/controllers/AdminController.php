<?php
require_once '../app/models/User.php';
require_once '../app/models/Categorie.php';
require_once '../app/models/Rubrique.php';
require_once 'BaseController.php';

class AdminController extends BaseController
{
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index()
    {

        if (!isset($_SESSION['type']) || $_SESSION['type'] != 0) {
            header('Location: ' . base_url('/home'));
            exit();
        }

        $userModel = new User($this->pdo);
        $categorieModel = new Categorie($this->pdo);
        $rubriqueModel = new Rubrique($this->pdo);

        $membres = $userModel->getAllUsers();
        $categories = $categorieModel->getAllCat();
        $rubriques = $rubriqueModel->getGroupedByCategorie();

        require_once '../app/views/admin/index.php';
    }

    public function updateType()
    {
        if (isset($_GET['idMemb'])) {
            $userModel = new User($this->pdo);
            $userModel->updateUser($_GET['idMemb']);
        }
    
        header('Location: ' . base_url('/admin/index'));
        exit();
    }

    public function deleteUser()
    {
        if (isset($_GET['idMemb'])) {
            $userModel = new User($this->pdo);
            $userModel->deleteUser($_GET['idMemb']);
        }
    
        header('Location: ' . base_url('/admin/index'));
        exit();
    }
}