<?php
class Rubrique
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllRub()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM rubrique');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRubByCat($idCat)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM rubrique WHERE idCat = :idCat ORDER BY nomRub ASC");
        $stmt->execute(['idCat' => $idCat]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
