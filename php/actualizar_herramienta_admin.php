<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Obtener los datos del formulario
    $IDherramienta = $_POST['IDherramienta'];
    $nombreherramienta = $_POST['nombreherramienta'];
    $descripcionherramienta = $_POST['descripcion'];
    $preciohora = $_POST['precio_hora'];
    $preciodia = $_POST['precio_dia'];
    $preciosemana = $_POST['precio_semana'];
    $cantidad_herramienta = $_POST['cantidad_herramienta'];

    // Definir directorio de destino para las imágenes
    $target_dir = "../img-herramientas/";

    // Si el usuario ha subido una nueva imagen
    if ($_FILES['imagenes']['name']) {
        $target_file = $target_dir . basename($_FILES["imagenes"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        if (getimagesize($_FILES["imagenes"]["tmp_name"]) === false) {
            $mensaje = "El archivo no es una imagen.";
            exit();
        }

        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            $mensaje = "La imagen ya existe.";
            exit();
        }

        // Limitar el tamaño de la imagen
        if ($_FILES["imagenes"]["size"] > 5000000) {
            $mensaje = "La imagen es demasiado grande.";
            exit();
        }

        // Permitir ciertos formatos de imagen
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $mensaje = "Solo se permiten imágenes JPG, JPEG, PNG, y GIF.";
            exit();
        }

        // Subir la imagen
        if (!move_uploaded_file($_FILES["imagenes"]["tmp_name"], $target_file)) {
            $mensaje = "Hubo un error al subir la imagen.";
            exit();
        }

        // Obtener la ruta de la nueva imagen
        $imagenes = $target_file;
    } else {
        // Si no se subió una nueva imagen, mantener la imagen actual (pasada en el formulario oculto)
        $imagenes = $_POST['imagenes_actual'];
    }

    // Actualizar los datos de la herramienta en la base de datos
    $sql = "UPDATE herramientas SET nombreherramienta = ?, descripcion = ?, precio_hora = ?, precio_dia = ?, precio_semana = ?, cantidad_herramienta = ?,  imagenes = ? WHERE IDherramienta = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssisi", $nombreherramienta, $descripcionherramienta, $preciohora, $preciodia, $preciosemana, $cantidad_herramienta, $imagenes, $IDherramienta);

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
            window.location.href = 'MisHerramientas.php';
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
