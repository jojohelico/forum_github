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
    
    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET typeMemb=(typeMemb +1)%3 where idMemb = :idMemb');
        return $stmt->execute([':idMemb' => $id]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE idMemb = :idMemb');
        return $stmt->execute([':idMemb' => $id]);
    }

    public function getPrenomFromArticle($idRub)
    {
        $stmt = $this->pdo->prepare('
            SELECT users.prenomMemb, users.typeMemb 
            FROM users 
            INNER JOIN article ON article.idMemb = users.idMemb 
            WHERE article.idRub = :idRub 
            ORDER BY article.dateArt DESC 
            LIMIT 1
        ');
        $stmt->execute(['idRub' => $idRub]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['prenomMemb' => '', 'typeMemb' => 2];
    }

    public function getPrenomById($id)
    {
        $stmt = $this->pdo->prepare('
            SELECT prenomMemb
            FROM users 
            WHERE idMemb = :id
        ');
        $stmt->execute(['idMemb' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['prenomMemb' => '', 'typeMemb' => 2];
    }

    // Get user info (prenom + type) from the latest reponse in a rubrique
    public function getPrenomFromReponse($idRub)
    {
        $stmt = $this->pdo->prepare('
            SELECT users.prenomMemb, users.typeMemb 
            FROM users 
            INNER JOIN reponse ON reponse.idMemb = users.idMemb
            INNER JOIN article ON article.idArt = reponse.idArt 
            WHERE article.idRub = :idRub 
            ORDER BY reponse.dateRep DESC 
            LIMIT 1
        ');
        $stmt->execute(['idRub' => $idRub]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['prenomMemb' => '', 'typeMemb' => 2];
    }

    public function getUserById($idMemb)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE idMemb= :idMemb');
        $stmt->execute(['idMemb' => $idMemb]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
