<?php

include_once 'config.php';

// Obtén el ID de usuario del argumento en la línea de comandos
if ($argc > 1) {
    $userId = $argv[1];
    $token = generateToken($userId);
    echo "Token generado para el usuario $userId: $token\n";
} else {
    echo "Por favor, proporciona un ID de usuario como argumento.\n";
}