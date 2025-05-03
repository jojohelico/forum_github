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
}
