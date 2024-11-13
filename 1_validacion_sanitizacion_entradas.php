<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validación y Sanitización de Entradas</title>
</head>
<body>

<h2>1. Validación y Sanitización</h2>
<form method="POST" action="">
    <label for="correo">Correo electrónico:</label><br>
    <input type="text" id="correo" name="correo" required><br><br>
    
    <label for="texto">Texto a sanitizar:</label><br>
    <textarea id="texto" name="texto" rows="4" cols="50" required></textarea><br><br>
    
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para validar el correo electrónico
    function validarCorreo($correo) {
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    // Función para sanitizar el texto y prevenir XSS
    function sanitizarTexto($texto) {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }

    // Obtener los datos enviados por el usuario
    $correo = $_POST['correo'];
    $texto = $_POST['texto'];

    // Validar el correo
    if (validarCorreo($correo)) {
        echo "<p>Correo válido: " . htmlspecialchars($correo) . "</p>";
    } else {
        echo "<p style='color:red;'>Correo inválido</p>";
    }

    // Sanitizar y mostrar el texto
    $textoSanitizado = sanitizarTexto($texto);
    echo "<p>Texto sanitizado: " . $textoSanitizado . "</p>";
}
?>

</body>
</html>
