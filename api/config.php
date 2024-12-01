<?php
// config.php
define('SECRET_KEY', '1234567890'); // Clave secreta para firmar el token

/* Función para generar un token (por simplicidad) para cada usuario que podamos tener
   de esta forma podemos verificar que usuario esta realizando la petición
*/
function generateToken($userId) {
    /** 
     * Aca generamos un token con un payload que contiene el id del usuario y una expiración de 1 hora
     */
    $payload = base64_encode(json_encode(['user_id' => $userId, 'exp' => time() + 3600]));
    $signature = hash_hmac('sha256', "$payload", SECRET_KEY, true);
    $token = "$payload." . base64_encode($signature);
    return $token;
}

// Función para verificar el token
function verifyToken($token) {
    /**
     * En esta funcion encapsulamos la comprobacion del token, si ha sido firmado con nuestra clave secreta
     * y si el token aun es valido
     *  */
    $parts = explode('.', $token);
    if (count($parts) === 2) {
        list($payload, $signature) = $parts;
        $expectedSignature = base64_encode(hash_hmac('sha256', "$payload", SECRET_KEY, true));
        if ($signature === $expectedSignature) {
            $payloadData = json_decode(base64_decode($payload), true);
            return $payloadData['exp'] > time() ? $payloadData['user_id'] : false;
        }
    }
    return false;
}
?>
