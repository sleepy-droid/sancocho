<?php
// index.php


require_once 'config/db/Database.php';
require_once 'app/controllers/UsuariosController.php';
require_once 'app/repositories/UsuarioRepository.php';
require_once 'app/controllers/RestaurantesController.php';
require_once 'app/repositories/RestauranteRepository.php';

$data = json_decode(file_get_contents('php://input'), true);
$requestMethod = $_SERVER['REQUEST_METHOD'];
$route = $data['route'] ?? null; // Suponiendo que 'route' es parte de los datos recibidos
// Asegúrate de que el método de solicitud sea POST
if ($requestMethod !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit;
}
// Tabla de enrutamiento
$routes = [
    'usuario' => [
        'controller' => 'UsuariosController',
        'repository' => 'UsuarioRepository',
    ],
    'restaurante' => [
        'controller' => 'RestaurantesController',
        'repository' => 'RestauranteRepository',
    ],
    // Agregar nuevas rutas aquí...
];

$database = Database::getInstance();

// Enrutador básico
if (isset($routes[$route])) {
    $controllerName = $routes[$route]['controller'];
    $repositoryName = $routes[$route]['repository'];
    
    $repository = new $repositoryName($database);
    $controller = new $controllerName($repository);
    
    $controller->processRequest($requestMethod, $data);
} else {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Route not found']);
    exit;
}
?>