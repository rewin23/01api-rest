<?php
// index.php
include_once 'config.php';
include_once 'SiteController.php';
include_once 'ServicesController.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_SERVER['PATH_INFO'], '/');
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

if (strpos($authHeader, 'Bearer ') === 0) {
    $token = substr($authHeader, 7);
    $userId = verifyToken($token);

    // lo dejo en 1 para que siempre pase la verificación y poder hacer pruebas
    if (1) {
        $servicesController = new ServicesController();
        $siteController = new SiteController();

        switch ($method) {
            case 'GET':
                if ($path === 'services') {
                    echo json_encode($servicesController->index());
                } 
                elseif (preg_match('/^services\/(\d+)$/', $path, $matches)) {
                    $user = $userController->show($matches[1]);
                    echo json_encode($user ? $user : ['error' => 'Servicio no encontrado']);
                }
                elseif ($path === 'about') {
                    echo json_encode($siteController->getAbout());
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'No encontrado']);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode(['error' => 'Metodo no permitido']);
                break;
        }
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
    }
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Authorization header not found']);
}
?>
