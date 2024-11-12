<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $propietario = $_POST['propietario']; // El nombre de usuario oculto del propietario
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
    $sql = "INSERT INTO herramientas (propietario, nombreherramienta, precio_hora, precio_dia, precio_semana, categoria, descripcion, imagenes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración SQL
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssdddsss", $propietario, $nombre_herramienta, $precio_hora, $precio_dia, $precio_semana, $categoria, $descripcion, $imagenes_guardadas);

        // Verificar si la inserción fue exitosa
        if ($stmt->execute()) {
            echo "Herramienta guardada exitosamente.";
        } else {
            echo "Error al guardar la herramienta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Manejar el error de la preparación de la consulta
        echo "Error en la consulta SQL: " . $conexion->error;
    }
}

$conexion->close();


?>

<script>
// Redirigir a login.html después de 3 segundos
setTimeout(function(){
    window.location.href = '../php/login.php';
}, 2000);
</script>