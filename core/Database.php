<?php
class Database
{
    private static $connexion = null;
    private $pdo;

    private function __construct()

    {
        $config = require '../config/config.php'; // Load DB credentials
        try {
            $this->pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
                $config['user'],
                $config['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            die('Database Connection Failed: ' . $e->getMessage());
        }
    }
 
    public static function getConnexion()
    {
        if (self::$connexion === null) {
            self::$connexion = new Database();
        }
        return self::$connexion->pdo;
    }
}
