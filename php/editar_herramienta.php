<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Obtener el ID del usuario
    $sql = "SELECT ID FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $IDusuario = $usuario['ID'];



    $sql = "SELECT nombreherramienta, marca_herramienta, tipo_herramienta, precio_hora, precio_dia, precio_semana, categoria, descripcion, imagenes FROM herramientas WHERE IDusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($nombreherramienta, $marca_herramienta, $tipo_herramienta, $precio_dia, $precio_hora, $precio_semana, $categoria, $descripcion, $imagenes);
    $stmt->fetch();
    $stmt->close();

} else {
    header("Location: login.php");
    exit;
}

// Obtener datos del artículo a editar (se espera un parámetro `id` en la URL)
$id_herramienta = $_GET['id'] ?? null;
if ($id_herramienta) {
    $sql = "SELECT nombreherramienta, marca_herramienta, tipo_herramienta, precio_hora, precio_dia, precio_semana, categoria, descripcion, imagenes
            FROM herramientas WHERE id = ? AND usuario_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_herramienta, $userID);
    $stmt->execute();
    $stmt->bind_result($nombreherramienta, $marca_herramienta, $tipo_herramienta, $precio_hora, $precio_dia, $precio_semana, $categoria, $descripcion, $imagenes);
    $stmt->fetch();
    $stmt->close();
} else {
    die("ID de herramienta no válido.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_herramienta = $_POST['id_herramienta'];
    $nombreherramienta = $_POST['nombreherramienta'];
    $marca_herramienta = $_POST['marca_herramienta'];
    $marca_herramienta = $_POST['tipo_herramienta'];
    $precio_hora = $_POST['precio_hora'];
    $precio_dia = $_POST['precio_dia'];
    $precio_semana = $_POST['precio_semana'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];

    $imagenes = $_FILES['imagenes'];
    $ruta_imagenes = [];

    $sql = "UPDATE herramientas SET nombreherramienta = ?, marca_herramienta = ?, tipo_herramienta = ?, precio_hora = ?, precio_dia = ?, precio_semana = ?, categoria = ?, descripcion = ?, imagenes = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssdddsssi", $nombreherramienta, $marca_herramienta, $tipo_herramienta, $precio_hora, $precio_dia, $precio_semana, $categoria, $descripcion, $imagenes, $id_herramienta);

    if ($stmt->execute()) {
        header("Location: lista_herramientas.php?mensaje=actualizado");
        exit;
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
    $stmt->close();
}
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/editar_herramienta.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Herramienta</title>
</head>
<body>
    <div class="container">
        <h2>Editar herramienta</h2>
        <form action="editar_herramienta.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_herramienta" value="<?php echo $id_herramienta; ?>">

            <div class="input-group">
                <label for="nombreherramienta">Nombre</label>
                <input type="text" id="nombreherramienta" name="nombreherramienta" value="<?php echo htmlspecialchars($nombreherramienta); ?>" required>
            </div>

            <div class="input-group">
                <label for="marca_herramienta">Marca</label>
                <input type="text" id="marca_herramienta" name="marca_herramienta" value="<?php echo htmlspecialchars($marca_herramienta); ?>" required>
            </div>

            <div class="input-group">
                <label for="tipo_herramienta">Tipo/Herramienta</label>
                <select  id="tipo_herramienta" name="tipo_herramienta" value="<?php echo htmlspecialchars($tipo_herramienta); ?>" required>
                    <option value="Eléctrica">Eléctrica</option>
                    <option value="Manual">Manual</option>
                </select>
            </div>

            <div class="form-group-inline">
                <div class="input-group">
                    <label for="precio_hora">Precio por hora</label>
                    <input type="number" id="precio_hora" name="precio_hora" value="<?php echo $precio_hora; ?>" required>
                </div>

                <div class="input-group">
                    <label for="precio_dia">Precio por día</label>
                    <input type="number" id="precio_dia" name="precio_dia" value="<?php echo $precio_dia; ?>" required>
                </div>

                <div class="input-group">
                    <label for="precio_semana">Precio por semana</label>
                    <input type="number" id="precio_semana" name="precio_semana" value="<?php echo $precio_semana; ?>" required>
                </div>
            </div>

            <div class="input-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="electrodomesticos" <?php echo $categoria == 'electrodomesticos' ? 'selected' : ''; ?>>Electrodomésticos</option>
                    <option value="manuales" <?php echo $categoria == 'manuales' ? 'selected' : ''; ?>>Manuales</option>
                </select>
            </div>

            <div class="input-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($descripcion); ?></textarea>
            </div>

            <div class="input-group">
                <label for="imagenes">Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" value="<?php echo $imagenes; ?>" multiple required>
            </div>
            <!-- Pass `IDusuario` instead of `nombre` -->
            <input type="hidden" name="IDusuario" value="<?php echo $userID; ?>">

            <button type="submit" class="btn-submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>