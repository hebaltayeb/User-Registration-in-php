<?php
session_start();
require_once "../config/database.php";
require_once "../core/Router.php";
require_once "../app/controllers/AuthController.php";
require_once "../app/controllers/UserController.php";

$router = new Router();
$authController = new AuthController($pdo);
$userController = new UserController($pdo);

// Homepage Test Route
$router->addRoute("/", function () {
    echo "Hi"; // Test if routing works
});

$router->addRoute("/users", function () use ($userController) {
    $userController->showUsers();
});

// Auth Routes (Remove `/public/` from paths)
$router->addRoute("/register", function () use ($authController) {
    $authController->register();
});

$router->addRoute("/login", function () use ($authController) {
    $authController->login();
});

// Handle request
$router->handleRequest($_SERVER["REQUEST_URI"]);
