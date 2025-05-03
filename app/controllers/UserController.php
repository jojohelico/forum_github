<?php
require_once '../app/models/User.php'; // Load User model

class UserController
{
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['motdepasse'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['mdpMemb'])) {
                $_SESSION['idMemb'] = $user['id'];
                $_SESSION['prenom'] = $user['prenomMemb'];
                $_SESSION['nom'] = $user['nomMemb'];
                $_SESSION['type'] = $user['typeMemb'];

                header('Location: ' . base_url('/home/index') . '');
                exit();
            } else {
                $_SESSION['error'] = "Mot de passe ou utilisateur incorrect";
                header('Location: ' . base_url('/user/login') . '');
                exit();
            }
        } else {
            require_once '../app/views/login.php';
        }
    }
    
    public function signIn()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();

            $email = $_POST['email'];

            if ($user->getUserByEmail($email)) {
                $_SESSION['error'] = "L'adresse mail existe déjà";
                header('Location: ' . base_url('/user/signIn') . '');
                exit();
            }

            $user->nom = $_POST['nom'];
            $user->prenom = $_POST['prenom'];
            $user->email = $email;
            $user->motdepasse = $_POST['motdepasse'];

            if ($user->createUser()) {
                $_SESSION['success'] = 'Compte créé avec succès. Connectez-vous.';
                header('Location: ' . base_url('/user/login') . '');

            } else {
                $_SESSION['error'] = 'Une erreur s\'est produite lors de la création du compte. Merci de réessayer.';
                header('Location: ' . base_url('/user/signIn') . '');
            }
        } else {
            require_once '../app/views/signIn.php';
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . base_url('/home/index'));
        exit();
    }

    public function nbMembres()
    {
        // Get the number of users from the model
        $nbUsers = $this->userModel->getNbUsers();

        // Pass the data to the view
        include '../app/views/home.php';
        
    }
}
