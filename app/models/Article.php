<?php

class Article
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function countByRubrique($idRub)
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as NbArt FROM article WHERE idRub = :idRub');
        $stmt->execute(['idRub' => $idRub]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['NbArt'];
    }

    public function getLastByRubrique($idRub)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM article WHERE idRub = :idRub ORDER BY dateArt DESC LIMIT 1');
        $stmt->execute(['idRub' => $idRub]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByRubrique($idRub) {
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE idRub = :idRub");
        $stmt->execute(['idRub' => $idRub]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getNbMessages($idArt) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as Nb FROM reponse WHERE idArt = :idArt");
        $stmt->execute(['idArt' => $idArt]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['Nb'] + 1;
    }
    
    public function createArt($titre, $contenu, $idMemb, $idRub) {
        $stmt = $this->pdo->prepare("INSERT INTO article (titreArt, contenuArt, idMemb, idRub) VALUES (?, ?, ?, ?)");
        $stmt->execute([$titre, $contenu, $idMemb, $idRub]);
    }

    public function deleteArt($idArt) {
        $stmt = $this->pdo->prepare("DELETE FROM article WHERE idArt = :idArt");
        $stmt->execute(['idArt' => $idArt]);
    }

    public function getById($idArt) {
        $stmt = $this->pdo->prepare("SELECT * FROM article WHERE idArt = ?");
        $stmt->execute([$idArt]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
