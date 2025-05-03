<?php
class Rubrique
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getGroupedByCategorie()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM rubrique');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
