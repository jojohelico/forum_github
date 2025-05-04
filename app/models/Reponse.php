<?php

class Reponse
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function countByRubrique($idRub)
    {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) as NbRep 
            FROM reponse 
            INNER JOIN article ON reponse.idArt = article.idArt 
            WHERE article.idRub = :idRub
        ');
        $stmt->execute(['idRub' => $idRub]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['NbRep'];
    }

    public function getLastByRubrique($idRub)
    {
        $stmt = $this->pdo->prepare('
            SELECT reponse.*, article.idRub, article.titreArt 
            FROM reponse 
            INNER JOIN article ON article.idArt = reponse.idArt 
            WHERE article.idRub = :idRub 
            ORDER BY dateRep DESC LIMIT 1
        ');
        $stmt->execute(['idRub' => $idRub]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByArticle($idArt) {
        $stmt = $this->pdo->prepare("SELECT * FROM reponse WHERE idArt = ?");
        $stmt->execute([$idArt]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($contenu, $idMemb, $idArt) {
        $stmt = $this->pdo->prepare("INSERT INTO reponse (contenuRep, idMemb, idArt) VALUES (?, ?, ?)");
        $stmt->execute([$contenu, $idMemb, $idArt]);
    }

    public function delete($idRep) {
        $stmt = $this->pdo->prepare("DELETE FROM reponse WHERE idRep = ?");
        $stmt->execute([$idRep]);
    }
}
