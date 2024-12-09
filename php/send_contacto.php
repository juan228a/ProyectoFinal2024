<?php
// Incluye los archivos necesarios de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'C:/xampp/htdocs/app/vendor/phpmailer/phpmailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Configurar PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto si usas otro servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'prestar2024@gmail.com'; // Tu dirección de correo
        $mail->Password = 'o c p i g s d v t fa e d z h p'; // Tu contraseña de aplicación o clave SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encriptación TLS
        $mail->Port = 587; // Puerto del servidor SMTP

        // Configuración del correo
        $mail->setFrom('prestar2024@gmail.com', 'Prest-AR'); // Cambia el remitente
        $mail->addAddress('prestar2024@gmail.com'); // Dirección a la que se enviará el mensaje

        // Configuración del mensaje
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto'; // Asunto del correo
        $mail->Body = "
            <h3>Nuevo Mensaje de Contacto</h3>
            <p><b>Nombre:</b> $name</p>
            <p><b>Correo Electrónico:</b> $email</p>
            <p><b>Mensaje:</b></p>
            <p>$message</p>
        ";

        // Enviar el correo
        $mail->send();

        header("Location: contacto.php"); // Cambia "gracias.html" por la página que desees
        exit(); // Finaliza el script después de la redirección
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
