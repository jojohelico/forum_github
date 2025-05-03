<?php
require_once 'BaseController.php';

class HomeController extends BaseController
{
    public function index() {
        require_once "../app/views/home.php";
    }
}
