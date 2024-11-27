<?php
session_start();
include 'conexion.php';

// Inicialización de variables
$nombre = $apellido = $email = $telefono = $IDherramienta = $date = $time = "";

// Verificar que el usuario esté autenticado
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Consultar datos del usuario desde la tabla usuarios
    $sql = "SELECT ID, nombre, apellido, email, telefono FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($IDusuario, $nombre, $apellido, $email, $telefono);
    $stmt->fetch();
    $stmt->close();
} else {
    header("Location: login.php");
    exit();
}

// Verificar si se recibieron datos del formulario anterior
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDherramienta = $_POST['IDherramienta'];
    $date = $_POST['fecha_reserva'];
    $time = $_POST['hora_reserva'];
} else {
    echo "No se recibieron datos del formulario.";
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prest-AR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="../css/ConfirmacionAlquiler.css">
</head>
<body>

<div id="page-wrap">
    <div id="fh5co-hero-wrapper">
        <nav class="container navbar navbar-expand-lg main-navbar-nav navbar-light">
            <a class="navbar-brand" href="">Prest-AR</a>
        </nav>
    </div>

    <br><br>

    <div class="infobox">
        <h3 class="Complet">Completar Alquiler</h3>
        <br>
        <h5 class="Complet">(Mediante estos datos, el dueño se comunicará con usted para confirmar su reserva!)</h5>
        <br>
        <form action="AlquilerCompletado.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $nombre ?>" readonly>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required value="<?php echo $apellido ?>" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $email ?>" readonly>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="direccion">Dirección Hogar:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="horas">Horas a alquilar:</label>
            <input type="number" id="horas" name="horas" required>

            <label for="experiencia">Experiencia con la herramienta:</label>
            <select  id="experiencia" name="experiencia" required>
            <option value="Nula">Nula</option>
            <option value="Baja">Baja</option>
             <option value="Media">Media</option>
             <option value="Alta">Alta</option>


            </select>

            <label for="informacion">Información extra que desee añadir:</label>
            <input type="text" id="informacion" name="informacion" required>

            <label for="fecha_reserva">Seleccionar fecha:</label>
            <input type="date" id="fecha_reserva" name="fecha_reserva" required value="<?php echo $date ?>" readonly>

            <label for="hora_reserva">Seleccionar hora:</label>
            <input type="time" id="hora_reserva" name="hora_reserva" required value="<?php echo $time ?>" readonly>

            <!-- Campo oculto para IDherramienta -->
            <input type="hidden" name="IDherramienta" value="<?php echo $IDherramienta ?>">

            <br><br>

            <button type="submit" class="submit-btn">Enviar Reserva</button>
        </form>
    </div>




	<br><br><br><br>
	<footer class="footer-outer">
		<p class="copyright">&copy; 2024 App. All rights reserved.</p>
	</footer>

</div>
</body>
</html>

