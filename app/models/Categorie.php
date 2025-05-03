<?php
class Categorie
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllCat()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM catégorie');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
