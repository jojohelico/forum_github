<?php
require_once '../core/Database.php';

class User
{
    private $pdo;

    public $nom;
    public $prenom;
    public $email;
    public $motdepasse;


    public function __construct()
    {
        $this->pdo = Database::getConnexion();
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE emailMemb = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser()
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (nomMemb, prenomMemb, emailMemb, mdpMemb)
        VALUES (:nom, :prenom, :email, :motdepasse)");
        return $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':motdepasse' => password_hash($this->motdepasse, PASSWORD_DEFAULT)
        ]);
    }

    public function getNbUsers() 
    {
        $stmtNbUsers = $this->pdo->prepare('SELECT COUNT(*) as NbUsers FROM users');
        $stmtNbUsers->execute();
        // Récupère le résultat de la colonne, ici une seule est affichée : NbUsers
        $NbMemb = $stmtNbUsers->fetchColumn();
        return $NbMemb;
    }

}
