<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['IDherramienta'])) {
    $IDherramienta = intval($_POST['IDherramienta']);

    if (!$conexion) {
        echo "Error en la conexión a la base de datos.";
        http_response_code(500);
        exit();
    }

    // Eliminar las referencias en carrito
    $sql_carrito = "DELETE FROM carrito WHERE IDherramienta = ?";
    $stmt_carrito = $conexion->prepare($sql_carrito);

    if ($stmt_carrito) {
        $stmt_carrito->bind_param("i", $IDherramienta);
        if (!$stmt_carrito->execute()) {
            echo "Error al eliminar en carrito: " . $stmt_carrito->error;
            http_response_code(500);
            $stmt_carrito->close();
            $conexion->close();
            exit();
        }
        $stmt_carrito->close();
    } else {
        echo "Error al preparar la consulta de carrito: " . $conexion->error;
        http_response_code(500);
        $conexion->close();
        exit();
    }

    // Eliminar la herramienta
    $sql = "DELETE FROM herramientas WHERE IDherramienta = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $IDherramienta);
        if ($stmt->execute()) {
            echo "Herramienta eliminada correctamente.";
            http_response_code(200);
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
            http_response_code(500);
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
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
            <h2>Herramienta eliminada con exito!</h2>
        </div>
    </div>
</body>
</html>