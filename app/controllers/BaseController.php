<?php
require_once '../app/models/Stats.php';

class BaseController
{
    protected $pdo;
    protected $stats;

    // Footer variables
    protected $articleCount;
    protected $messageCount;
    protected $userCount;
    protected $latestMember;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->stats = new Stats($pdo);
        $this->loadFooterStats();
    }

    protected function loadFooterStats()
    {
        $this->articleCount = $this->stats->getArticleCount();
        $this->messageCount = $this->stats->getTotalMessages();
        $this->userCount = $this->stats->getUserCount();
        $this->latestMember = $this->stats->getLastMemberName();
    }
}

?>