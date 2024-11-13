<?php
// Clave secreta para firmar el JWT
$claveSecreta = "mi_clave_secreta";

// Datos del usuario que queremos incluir en el JWT
$datosUsuario = [
    "id" => 123,
    "nombre" => "usuarioEjemplo",
    "email" => "usuario@ejemplo.com"
];

// Configuración de los datos del JWT
$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
$payload = json_encode([
    'iss' => 'http://mi-sitio-web.com',   // Emisor del token
    'aud' => 'http://mi-sitio-web.com',   // Audiencia del token
    'iat' => time(),                      // Tiempo en el que se emitió el token
    'exp' => time() + 3600,               // Tiempo de expiración (1 hora)
    'data' => $datosUsuario               // Datos del usuario
]);

// Codificar en base64 URL
function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

// Crear el JWT
$base64UrlHeader = base64UrlEncode($header);
$base64UrlPayload = base64UrlEncode($payload);
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $claveSecreta, true);
$base64UrlSignature = base64UrlEncode($signature);

// El JWT generado
$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

echo "Token JWT generado: " . $jwt;
?>
