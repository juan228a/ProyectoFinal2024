<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_usuario = $_POST['IDusuario']; // Ahora obtenemos el ID del usuario directamente desde el formulario
    $nombre_herramienta = $_POST['nombreherramienta'];
    $precio_hora = $_POST['precio_hora'];
    $precio_dia = $_POST['precio_dia'];
    $precio_semana = $_POST['precio_semana'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    // Procesar múltiples imágenes
    $imagenes = $_FILES['imagenes'];
    $ruta_imagenes = [];

    // Definir directorio de destino para las imágenes
    $target_dir = "../img-herramientas/";

    // Subir cada imagen y guardarla en el array
    for ($i = 0; $i < count($imagenes['name']); $i++) {
        $target_file = $target_dir . basename($imagenes['name'][$i]);
        if (move_uploaded_file($imagenes["tmp_name"][$i], $target_file)) {
            $ruta_imagenes[] = $target_file;
        }
    }

    // Convertir el array de imágenes en una cadena separada por comas
    $imagenes_guardadas = implode(",", $ruta_imagenes);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO herramientas (IDusuario, nombreherramienta, precio_hora, precio_dia, precio_semana, categoria, descripcion, imagenes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("isdddsss", $id_usuario, $nombre_herramienta, $precio_hora, $precio_dia, $precio_semana, $categoria, $descripcion, $imagenes_guardadas);

        // Verificar si la inserción fue exitosa
        if ($stmt->execute()) {
            $mensaje =  "Herramienta guardada exitosamente.";
        } else {
            $mensaje =  "Error al guardar la herramienta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Manejar el error de la preparación de la consulta
        $mensaje =  "Error en la consulta SQL: " . $conexion->error;
    }
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
            window.location.href = 'index.php';
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
