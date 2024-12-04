<?php

// Iniciar la sesión
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'])) {
    $ID = intval($_POST['ID']);

    if (!$conexion) {
        echo "Error en la conexión a la base de datos.";
        http_response_code(500);
        exit();
    }

    // Eliminar los registros relacionados en la tabla carrito que dependen de herramientas
    $sql_carrito = "DELETE FROM carrito WHERE IDherramienta IN (SELECT IDherramienta FROM herramientas WHERE IDusuario = ?)";
    $stmt_carrito = $conexion->prepare($sql_carrito);
    if ($stmt_carrito) {
        $stmt_carrito->bind_param("i", $ID);
        $stmt_carrito->execute();
        $stmt_carrito->close();
    }

    // Eliminar los registros relacionados en la tabla herramientas
    $sql_herramientas = "DELETE FROM herramientas WHERE IDusuario = ?";
    $stmt_herramientas = $conexion->prepare($sql_herramientas);
    if ($stmt_herramientas) {
        $stmt_herramientas->bind_param("i", $ID);
        $stmt_herramientas->execute();
        $stmt_herramientas->close();
    }

    // Luego eliminar el usuario
    $sql_usuario = "DELETE FROM usuarios WHERE ID = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    if ($stmt_usuario) {
        $stmt_usuario->bind_param("i", $ID);
        if ($stmt_usuario->execute()) {
            echo "Usuario eliminado correctamente.";
            http_response_code(200);
        } else {
            echo "Error al eliminar el usuario: " . $stmt_usuario->error;
            http_response_code(500);
        }
        $stmt_usuario->close();
    } else {
        echo "Error al preparar la consulta del usuario: " . $conexion->error;
        http_response_code(500);
    }

    $conexion->close();
} else {
    echo "Datos no válidos.";
    http_response_code(400);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Actualización</title>
    <link rel="stylesheet" href="../css/login.css">
    <script>
        // Redirigir a editoruser.php después de 3 segundos
        setTimeout(function(){
            window.location.href = 'AdministrarPerfiles.php';
        }, 2000);
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <h2>Usuario eliminado con exito!</h2>
        </div>
    </div>
</body>
</html>