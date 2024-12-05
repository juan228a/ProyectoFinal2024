<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';
// Inicializar variables para almacenar los datos del usuario
$usuario = $nombre = $apellido = $email = $telefono = $provincia = $ciudad = $codigopostal = $dni = $descripcion = "";

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Retrieve the user's ID from the database
    $sql = "SELECT ID, nombre, email FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userID, $nombre,$email);
    $stmt->fetch();
    $stmt->close();
} else {
    $userID = null;
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
<link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="container">
        <h2>Añadir herramienta</h2>
        <form action="guardar_herramienta.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="nombreherramienta"><b>Nuevo articulo</b></label>
                <input type="text" id="nombreherramienta" name="nombreherramienta" placeholder="Ponle un nombre" required>
            </div>

            <div class="input-group">
                <label for="marca_herramienta"><b>Marca</b></label>
                <input type="text" id="marca_herramienta" name="marca_herramienta" placeholder="Ponle un nombre" required>
            </div>

            <div class="input-group">
                <label for="tipo_herramienta"><b>Tipo/Herramienta</b></label>
                <select  id="tipo_herramienta" name="tipo_herramienta" required>
                    <option value="Eléctrica">Eléctrica</option>
                    <option value="Manual">Manual</option>
                </select>
            </div>


            <div class="form-group-inline">
                <div class="input-group">
                    <label for="precio_hora"><b>Precio por hora</b></label>
                    <input type="number" id="precio_hora" name="precio_hora" placeholder="Precio por hora" required>
                </div>

                <div class="input-group">
                    <label for="precio_dia"><b>Precio por día</b></label>
                    <input type="number" id="precio_dia" name="precio_dia" placeholder="Precio por día" required>
                </div>

                <div class="input-group">
                    <label for="precio_semana"><b>Precio por semana</b></label>
                    <input type="number" id="precio_semana" name="precio_semana" placeholder="Precio por semana" required>
                </div>
            </div>

            <div class="input-group">
                    <label for="cantidad_herramienta"><b>Stock(Cantidad)</b></label>
                    <input type="number" id="cantidad_herramienta" name="cantidad_herramienta" placeholder="Cantidad de Herramientas" required>
                </div>


            <div class="input-group">
                <label for="descripcion"><b>Descripción</b></label>
                <textarea id="descripcion" name="descripcion" placeholder="Describe el producto" required></textarea>
            </div>

          
            <div class="input-group">
                <label for="imagenes"><b>Imágenes</b></label>
                <input type="file" id="imagenes" name="imagenes[]" multiple required>
            </div>
            <!-- Pass `IDusuario` instead of `nombre` -->
            <input type="hidden" name="IDusuario" value="<?php echo $userID; ?>">

            <button type="submit" class="btn-submit">Añadir herramienta</button>
        </form>
    </div>
</body>
</html>


