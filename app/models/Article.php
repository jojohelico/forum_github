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
}
