<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $codigopostal = $_POST['codigopostal'];
    $dni = $_POST['dni'];
    $descripcion = $_POST['descripcion'];


   // Actualizar los datos del usuario en la base de datos
$sql = "UPDATE usuarios SET usuario = ?, nombre = ?, apellido = ?, email = ?, telefono = ?, provincia = ?, ciudad = ?, codigopostal = ?, dni = ?, descripcion = ? WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssssss", $usuario, $nombre, $apellido, $email, $telefono, $provincia, $ciudad, $codigopostal, $dni, $descripcion, $usuario); // Agregar $usuario al final

    if ($stmt->execute()) {
        $mensaje = "Actualización exitosa.";
    } else {
        $mensaje = "Error en la actualización: " . $stmt->error;
    }

    $stmt->close();
} else {
    $mensaje = "No has iniciado sesión.";
}

$conexion->close();
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
            window.location.href = 'editperfil.php';
        }, 2000);
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <h2><?php echo $mensaje; ?></h2>
        </div>
    </div>
</body>
</html>
