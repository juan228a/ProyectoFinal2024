<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Recuperar el nombre del usuario de la base de datos
    $sql = "SELECT nombre FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($nombre);
    $stmt->fetch();
    $stmt->close();
} else {
    $nombre = "";
    $username = "Log In";
}

$conexion->close();




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- addherramienta style  -->
    <link rel="stylesheet" href="../css/add_herramienta.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Herramienta</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">

</head>
<body>
   
    <div class="container">
        <h2>Añadir herramienta</h2>
        <form action="guardar_herramienta.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="nombreherramienta">Nuevo articulo</label>
                <input type="text" id="nombreherramienta" name="nombreherramienta" placeholder="Ponle un nombre" required>
            </div>

            <div class="form-group-inline">
                <div class="input-group">
                    <label for="precio_hora">Precio por hora</label>
                    <input type="number" id="precio_hora" name="precio_hora" placeholder="Precio por hora" required>
                </div>

                <div class="input-group">
                    <label for="precio_dia">Precio por día</label>
                    <input type="number" id="precio_dia" name="precio_dia" placeholder="Precio por día" required>
                </div>

                <div class="input-group">
                    <label for="precio_semana">Precio por semana</label>
                    <input type="number" id="precio_semana" name="precio_semana" placeholder="Precio por semana" required>
                </div>
            </div>

            <div class="input-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="electrodomesticos">Electrodomésticos</option>
                    <option value="manuales">Manuales</option>                  
                </select>
            </div>

            <div class="input-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" placeholder="Describe el producto" required></textarea>
            </div>

            <div class="input-group">
                <label for="imagenes">Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" multiple required>
            </div>
            <!-- Campo oculto para el nombre de usuario -->
            <input type="hidden" name="propietario" value="<?php echo $nombre; ?>">

            <button type="submit"  class="btn-submit">Añadir herramienta</button>
       
   
        </form>
   
    </div>
 

</body>


</html>

