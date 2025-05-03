<?php
require_once '../core/Database.php'; 
$pdo = Database::getConnexion(); 

class Router {
    public function run() {
        $pdo = Database::getConnexion(); 
        // Get URL from browser (or default to 'home/index')
        $url = isset($_GET['url']) ? $_GET['url'] : 'home/index';

        // Split URL into parts (e.g., "/user/profile" → ['user', 'profile'])
        $urlParts = explode('/', trim($url, '/'));

        // Define controller and method
        $controllerName = ucfirst($urlParts[0]) . 'Controller'; // Example: UserController
        $methodName = isset($urlParts[1]) ? $urlParts[1] : 'index'; // Default method is 'index'

        // Define controller path
        $controllerFile = "../app/controllers/$controllerName.php";

        // Check if controller exists
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName($pdo);

            // Check if method exists in the controller
            if (method_exists($controller, $methodName)) {
                $controller->$methodName(); // Call the method dynamically
            } else {
                echo "404 Not Found - Method does not exist.";
            }
        } else {
            echo "404 Not Found - Controller does not exist.";
        }
    }
}
