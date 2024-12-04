<?php
session_start();
include 'conexion.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDherramienta = $_POST['IDherramienta'];
    $date = $_POST['fecha_reserva'];
    $time = $_POST['hora_reserva'];
    $direccion = $_POST['direccion'];
    $horas = $_POST['horas'];
    $experiencia = $_POST['experiencia'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $email_propietario = $_POST['propietario_email'];
    $nombre_herramienta = $_POST['nombre_herramienta'];

    // Recuperar el IDusuario desde la sesión
    $username = $_SESSION['username'];
    $sql = "SELECT ID, nombre, apellido FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($IDusuario, $nombre, $apellido);
    $stmt->fetch();
    $stmt->close();

    // Insertar la reserva en el carrito
    insertarEnCarrito($IDherramienta, $IDusuario, $nombre, $apellido, $email, $telefono, $direccion, $horas, $experiencia, $date, $time);

    // Enviar correo de confirmación
    enviarCorreo($nombre, $apellido, $email, $email_propietario,$nombre_herramienta, $telefono, $direccion, $horas, $experiencia, $date, $time);

    // Redirigir al usuario a MisAlquileres.php después de completar el proceso
    header("Location: MisAlquileres.php");
    exit();
    
} else {
    echo "No se recibieron datos del formulario.";
    exit();
}

// Función para insertar en el carrito
function insertarEnCarrito($IDherramienta, $IDusuario, $nombre, $apellido, $email, $telefono, $direccion, $horas, $experiencia, $date, $time) {
    global $conexion;

    $sql = "INSERT INTO carrito (IDherramienta, IDusuario, nombre, apellido, email, telefono, direccion, horas, experiencia, fecha_reserva, hora_reserva, fecha_creacion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iisssssssss", $IDherramienta, $IDusuario, $nombre, $apellido, $email, $telefono, $direccion, $horas, $experiencia, $date, $time);

    if (!$stmt->execute()) {
        echo "Error al insertar en la base de datos: " . $stmt->error;
    }

    $stmt->close();
}

function enviarCorreo($nombre, $apellido, $email, $email_propietario, $nombre_herramienta,$telefono, $direccion, $horas, $experiencia, $date, $time) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del primer correo
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prestar2024@gmail.com';
        $mail->Password = 'o c p i g s d v t fa e d z h p'; // Cambia esto por tu contraseña de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('prestar2024@gmail.com', 'Prest-AR');
        $mail->addAddress($email); // Destinatario original

        $mail->isHTML(true);
        $mail->Subject = "Confirmacion de Reserva - Prest-AR";
        $mail->Body = "
        <html>
        <body>
            <h2>Detalles de la Reserva</h2>
            <p><strong>Nombre:</strong> $nombre $apellido</p>
            <p><strong>Herramienta alquilada:</strong> $nombre_herramienta$</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Horas:</strong> $horas</p>
            <p><strong>Experiencia:</strong> $experiencia</p>
            <p><strong>Fecha de Reserva:</strong> $date</p>
            <p><strong>Hora de Reserva:</strong> $time</p>
            <p><strong>Herramienta alquilada:</strong> $nombre_herramienta$</p>
        </body>
        </html>
        ";
        
        $mail->send();
        echo "Primer correo enviado.<br>";

        // Configuración del segundo correo
        $mail->clearAddresses(); // Limpia destinatarios anteriores
        $mail->addAddress($email_propietario); // Segundo destinatario
        $mail->Subject = "Nueva Reserva Recibida";
        $mail->Body = "
        <html>
        <body>
            <h2>Notificación de Nueva Reserva</h2>
            <p>Se ha realizado una nueva reserva con los siguientes detalles:</p>
            <p><strong>Nombre:</strong> $nombre $apellido</p>
            <p><strong>Herramienta alquilada:</strong> $nombre_herramienta$</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Horas:</strong> $horas</p>
            <p><strong>Experiencia:</strong> $experiencia</p>
            <p><strong>Fecha de Reserva:</strong> $date</p>
            <p><strong>Hora de Reserva:</strong> $time</p>
        </body>
        </html>
        ";

        $mail->send();
        echo "Segundo correo enviado.<br>";
    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
