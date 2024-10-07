<?php
// Iniciar la sesión para almacenar los datos temporalmente
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Inicializar variables para almacenar los datos del usuario
$nombre = $apellido = $email = $password = $telefono = $provincia = $ciudad = $descripcion = "";

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Recuperar los datos del usuario de la base de datos
    $sql = "SELECT nombre, apellido, email, password , telefono, provincia, ciudad, descripcion FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($nombre, $apellido, $email, $password, $telefono, $provincia, $ciudad, $descripcion);
    $stmt->fetch();
    $stmt->close();
} else {
    // Si no ha iniciado sesión, redirigir a la página de login
    header("Location: ../html/login.html");
    exit();
}

// Capturar los datos del formulario de fecha y hora
if (isset($_POST['reservation-date']) && isset($_POST['reservation-time'])) {
    // Guardar los valores de fecha y hora en variables
    $date = $_POST['reservation-date'];
    $time = $_POST['reservation-time'];
    
    // Guardar los datos en la sesión
    $_SESSION['reservation_date'] = $date;
    $_SESSION['reservation_time'] = $time;
} else {
    // Si no se han enviado datos, mostrar mensaje de error
    echo "No se ha seleccionado una fecha y hora.";
    exit();
}

$conexion->close();
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
        <form action="confirmacionCarrito.php" method="POST">
            <label for="nombre">Nombre:<b></b></label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $nombre?>" readonly>

			<label for="apellido">Apellido:<b></b></label>
            <input type="text" id="apellido" name="apellido" required value="<?php echo $apellido?>" readonly>

            <label for="email"><b>Email:</b></label>
            <input type="email" id="email" name="email" required value="<?php echo $email?>" readonly>

            <label for="telefono"><b>Teléfono:</b></label>
            <input type="tel" id="telefono" name="telefono" required>

			<label for="direccion"><b>Dirección Hogar:</b></label>
            <input type="text" id="direccion" name="direccion" required>

			<label for="horas"><b>Horas a alquilar:</b></label>
            <input type="number" id="horas" name="horas" required>

			<label for="experiencia"><b>Experiencia con la herramienta:</b></label>
            <input type="text" id="experiencia" name="experiencia" required>

			<label for="informacion"><b>Información extra que desee añadir:</b></label>
            <input type="text" id="informacion" name="informacion" required>

			<!-- Campo para la selección de la fecha -->
			<label for="fecha"><b>Seleccionar fecha:</b></label>
            <input type="date" id="reservation-date" name="reservation-date" required>

			<!-- Campo para la selección de la hora -->
			<label for="hora"><b>Seleccionar hora:</b></label>
            <input type="time" id="reservation-time" name="reservation-time" required>

			<br><br>

			<h3><b>Su reserva quedará registrada a confirmar por el Dueño de la herramienta para el día: 
				<?php echo isset($_SESSION['reservation_date']) ? $_SESSION['reservation_date'] : ''; ?> 
				y la hora: 
				<?php echo isset($_SESSION['reservation_time']) ? $_SESSION['reservation_time'] : ''; ?>
			</b></h3>
			<br>
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
