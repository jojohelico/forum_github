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

    public function getById($idRub) {
        $stmt = $this->pdo->prepare("SELECT * FROM rubrique WHERE idRub = ?");
        $stmt->execute([$idRub]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRub($descRub, $idCat, $nomRub) {
        $stmt = $this->pdo->prepare("INSERT INTO rubrique (descRub, idCat, nomRub) VALUES (?, ?, ?)");
        $stmt->execute([$descRub, $idCat, $nomRub]);
    }

    public function deleteRub($idRub) {
        $stmt = $this->pdo->prepare("DELETE FROM rubrique WHERE idRub = :idRub");
        $stmt->execute(['idRub' => $idRub]);
    }

    public function modifRub($idRub, $nomRub, $descRub) {
        $stmt = $this->pdo->prepare("UPDATE rubrique SET nomRub = ?, descRub = ? WHERE idRub = ?");
        $stmt->execute([$nomRub, $descRub, $idRub]);
    }
}
