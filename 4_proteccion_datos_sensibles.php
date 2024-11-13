<?php
// Lógica de registro y verificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrar'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Hasheamos la contraseña usando password_hash
        $contrasenaHasheada = password_hash($contrasena, PASSWORD_DEFAULT);
        
        // Guardamos datos en un txt Simulando una base de datos para no usar una BD en el ejemplo
        file_put_contents('usuarios.txt', "$usuario:$contrasenaHasheada\n", FILE_APPEND);
        
        echo "Usuario '$usuario' registrado con éxito. <br>";
        echo "Contraseña hasheada: $contrasenaHasheada";
    } elseif (isset($_POST['login'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $usuariosGuardados = file('usuarios.txt', FILE_IGNORE_NEW_LINES);

        $loginExitoso = false;
        foreach ($usuariosGuardados as $registro) {
            list($usuarioGuardado, $contrasenaHasheada) = explode(':', $registro);
            
            // Verificamos si los datos son correctoss
            if ($usuarioGuardado === $usuario && password_verify($contrasena, $contrasenaHasheada)) {
                $loginExitoso = true;
                break;
            }
        }
        
        if ($loginExitoso) {
            echo "¡Login exitoso para el usuario '$usuario'!";
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro y Login</title>
</head>
<body>

    <h2>Registro de Usuario</h2>
    <form method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>

    <h2>Login</h2>
    <form method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        <button type="submit" name="login">Iniciar sesión</button>
    </form>

</body>
</html>
