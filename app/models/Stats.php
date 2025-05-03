<?php

class Stats
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getArticleCount() {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM article');
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getTotalMessages() {
        $stmtArticles = $this->pdo->prepare('SELECT COUNT(*) as NbArt FROM article');
        $stmtArticles->execute();
        $articles = $stmtArticles->fetch(PDO::FETCH_ASSOC);

        $stmtReplies = $this->pdo->prepare('SELECT COUNT(*) as NbRep FROM reponse');
        $stmtReplies->execute();
        $replies = $stmtReplies->fetch(PDO::FETCH_ASSOC);

        return $articles['NbArt'] + $replies['NbRep'];
    }

    public function getUserCount() {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users');
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getLastMemberName() {
        $stmt = $this->pdo->prepare('SELECT nomMemb FROM users ORDER BY dateIns DESC LIMIT 1');
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
