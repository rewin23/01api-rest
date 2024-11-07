<?php
// config.php
define('SECRET_KEY', 'TuClaveSecretaSuperSegura');

// Función para generar un token (por simplicidad)
function generateToken($userId) {
    $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64_encode(json_encode(['user_id' => $userId, 'exp' => time() + 3600]));
    $signature = hash_hmac('sha256', "$header.$payload", SECRET_KEY, true);
    $token = "$header.$payload." . base64_encode($signature);
    return $token;
}

// Función para verificar el token
function verifyToken($token) {
    $parts = explode('.', $token);
    if (count($parts) === 3) {
        list($header, $payload, $signature) = $parts;
        $expectedSignature = base64_encode(hash_hmac('sha256', "$header.$payload", SECRET_KEY, true));
        if ($signature === $expectedSignature) {
            $payloadData = json_decode(base64_decode($payload), true);
            return $payloadData['exp'] > time() ? $payloadData['user_id'] : false;
        }
    }
    return false;
}
?>
