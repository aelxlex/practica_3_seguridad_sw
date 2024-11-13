<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Sesión con HttpOnly y Secure en Cookies</title>
</head>
<body>

<?php
// Configuración de cookies de sesión con HttpOnly y Secure
$cookieParams = session_get_cookie_params();
session_set_cookie_params([
    'lifetime' => $cookieParams["lifetime"],
    'path' => $cookieParams["path"],
    'domain' => $cookieParams["domain"],
    'secure' => true,        // Solo se enviará la cookie por HTTPS
    'httponly' => true,      // La cookie no es accesible desde JavaScript
    'samesite' => 'Strict'   // Protege contra CSRF en algunos casos
]);

// Iniciar la sesión
session_start();

// Sesión de ejemplo
$_SESSION['usuario'] = "usuarioEjemplo";
$_SESSION['login'] = true;

// Mostrar mensaje de confirmación
echo "<p>La sesión se ha iniciado con los atributos HttpOnly y Secure en las cookies.</p>";
?>

<h2>Información de la Sesión</h2>
<p><strong>Usuario:</strong> <?php echo $_SESSION['usuario']; ?></p>
<p><strong>Estado de sesión (login):</strong> <?php echo $_SESSION['login'] ? 'Activo' : 'Inactivo'; ?></p>

</body>
</html>
