<?php
// index.php
include_once 'config.php';
include_once 'SiteController.php';
include_once 'ServicesController.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_SERVER['PATH_INFO'], '/');
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

header("Access-Control-Allow-Origin: *"); // restriccion de acceso desde otros servidores
header("Access-Control-ALlow-Methods: GET"); // metodos permitidos
header("Content-Type: application/json; charset=UTF-8");


//Configuración de Authorization
$_authorization = null;
try {
    if (isset(getallheaders()['Authorization'])) {
        // obtener el token de la cabecera de autorización
        $_authorization = getallheaders()['Authorization'];

        // obtenemos solo el token separandolo de la palabra Bearer
        $token = explode(' ', $_authorization)[1];

        $userId = verifyToken($token);

        // verificamos si el usuario esta autorizado

        if ($userId) {
            $servicesController = new ServicesController();
            $siteController = new SiteController();

            switch ($method) {
                case 'GET':
                    // si el metodo es get y se llama a la ruta services devolvemos todos los servicios
                    if ($path === 'services') {
                        echo json_encode($servicesController->index());
                    } 
                    // si el metodo es get y se llama a la ruta services/numero devolvemos el servicio con ese id
                    elseif (preg_match('/^services\/(\d+)$/', $path, $matches)) {
                        $user = $userController->show($matches[1]);
                        echo json_encode($user ? $user : ['error' => 'Servicio no encontrado']);
                    }
                    // si el metodo es get y se llama a la ruta about devolvemos la informacion de about
                    elseif ($path === 'about') {
                        echo json_encode($siteController->getAbout());
                    // si el metodo es get pero se llama a cualquier otra ruta devolvemos no encontrado
                    } else {
                        http_response_code(404);
                        echo json_encode(['error' => 'No encontrado']);
                    }
                    break;

                default:
                    http_response_code(405);
                    // Aca devolvemos no permitido en vez de no implementado como medida de seguridad
                    // ya que entregar información sobre los métodos permitidos o como se implementarían puede entregar informacion
                    // a un posible atacante
                    echo json_encode(['error' => 'Metodo no permitido']);
                    break;
                }
            } else {
                // si el usuario no esta autorizado devolvemos un error 401 de no autorizado
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized']);
            }
        } else {
            // si no se encuentra la cabecera de autorizacion devolvemos un error 401 de no autorizado
            http_response_code(401);
            echo json_encode(['error' => 'Authorization header not found']);
    }
}
catch (Exception $e) {
    echo 'error';
}
?>
