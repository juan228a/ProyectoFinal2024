<?php

session_start();
include 'conexion.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/Exception.php';




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nombre = $apellido = $email = $telefono = $provincia = $ciudad = $descripcion = "";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT nombre, apellido, email, telefono FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($nombre, $apellido, $email, $telefono);
    $stmt->fetch();
    $stmt->close();
} else {
    header("Location: ../html/login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $horas = $_POST['horas'];
    $experiencia = $_POST['experiencia'];
    $informacion = $_POST['informacion'];
    $date = $_POST['reservation-date'];
    $time = $_POST['reservation-time'];
    $email_destinatario = $email;

    $subject = "Confirmación de Reserva - Prest-AR";
    $message = "
    <html>
    <body>
        <h2>Detalles de la Reserva</h2>
        <p><strong>Nombre:</strong> $nombre $apellido</p>
        <p><strong>Teléfono:</strong> $telefono</p>
        <p><strong>Dirección:</strong> $direccion</p>
        <p><strong>Horas a alquilar:</strong> $horas</p>
        <p><strong>Experiencia con la herramienta:</strong> $experiencia</p>
        <p><strong>Fecha de reserva:</strong> $date</p>
        <p><strong>Hora de reserva:</strong> $time</p>
    </body>
    </html>
    ";

    $mail = new PHPMailer(true);

    try {


     

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prestar2024@gmail.com'; // Cambia a tu correo
        $mail->Password = 'o c p i g s d v t fa e d z h p'; // Cambia a tu contraseña o token de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('prestar2024@gmail.com', 'Prest-AR');
        $mail->addAddress($email_destinatario);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "Correo enviado exitosamente.";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
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
        <form  method="post">
            <label for="nombre">Nombre:<b></b></label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $nombre ?>" readonly>

			<label for="apellido">Apellido:<b></b></label>
            <input type="text" id="apellido" name="apellido" required value="<?php echo $apellido ?>" readonly>

            <label for="email"><b>Email:</b></label>
            <input type="email" id="email" name="email" required value="<?php echo $email ?>" readonly>

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
