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

    // Consultar el email del propietario de la herramienta
    $sql_propietario = "
        SELECT usuarios.email 
        FROM usuarios 
        INNER JOIN herramientas ON usuarios.ID = herramientas.IDusuario 
        WHERE herramientas.IDherramienta = ?";
    $stmt_propietario = $conexion->prepare($sql_propietario);
    $stmt_propietario->bind_param("i", $IDherramienta);
    $stmt_propietario->execute();
    $stmt_propietario->bind_result($propietario_email);
    $stmt_propietario->fetch();
    $stmt_propietario->close();

    // Consultar el nombre de la herramienta
    $sql_herramienta = "SELECT nombreherramienta FROM herramientas WHERE IDherramienta = ?";
    $stmt_herramienta = $conexion->prepare($sql_herramienta);
    $stmt_herramienta->bind_param("i", $IDherramienta);
    $stmt_herramienta->execute();
    $stmt_herramienta->bind_result($nombre_herramienta);
    $stmt_herramienta->fetch();
    $stmt_herramienta->close();

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
    <link rel="stylesheet" href="../css/bootstrap.css">
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

            <label for="propietario_email">Email del Propietario:</label>
            <input type="email" id="propietario_email" name="propietario_email" required value="<?php echo $propietario_email ?>" readonly>

            <label for="nombre_herramienta">Nombre de la Herramienta:</label>
            <input type="text" id="nombre_herramienta" name="nombre_herramienta" required value="<?php echo $nombre_herramienta ?>" readonly>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="direccion">Dirección Hogar:</label>
            <input type="text" id="direccion" name="direccion" required>

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

            <label for="tipo_de_alquiler">Tipo de alquiler:</label>
                <select id="tipo_de_alquiler" name="tipo_de_alquiler" onchange="calcularPrecio()" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="hora">Por Horas</option>
                    <option value="dia">Por Día</option>
                    <option value="semana">Por Semana</option>
                </select>

            <label for="cantidad_carrito">Cantidad (Horas, Días o Semanas):</label>
            <input type="number" id="cantidad_carrito" name="cantidad_carrito" min="1" onchange="calcularPrecio()" required>

    

            <!-- Campo oculto para IDherramienta -->
            <input type="hidden" name="IDherramienta" value="<?php echo $IDherramienta ?>">

            <br><br>

            <button type="submit" class="submit-btn">Enviar Reserva</button>
        </form>
    </div>

	<br><br><br><br>
	<footer class="footer-outer">
		<div class="container footer-inner">

			<div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.66s">
				<div class="column-1-3">
					<h1>Prest-AR</h1>
				</div>
				<div class="column-2-3">
					<nav class="footer-nav">
						<ul>
							<a href="index.php"><li>Inicio</li></a>
							
							<a href="../html/terminos-y-condiciones.html" onclick="$('#fh5co-reviews').goTo();return false;"><li>Terminos Y Condiciones</li></a>
							<a href="../html/Privacidad.html" onclick="$('#fh5co-reviews').goTo();return false;"><li>Privacidad</li></a>
							
						</ul>
					</nav>
				</div>
				<div class="column-3-3">
					<div class="social-icons-footer">
						<a href="https://www.facebook.com/fh5co"><i class="fab fa-facebook-f"></i></a>
						<a href="https://freehtml5.co"><i class="fab fa-instagram"></i></a>
						<a href="https://www.twitter.com/fh5co"><i class="fab fa-twitter"></i></a>
					</div>
				</div>
			</div>

			<span class="border-bottom-footer"></span>

			<p class="copyright">&copy; 2024 Prest-AR. Todos los derechos reservados.</p>

		</div>
	</footer>
</div>





</body>
</html>

