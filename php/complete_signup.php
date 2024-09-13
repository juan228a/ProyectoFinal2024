<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Variable para el mensaje
$mensaje = "";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los datos del primer formulario están en la sesión
    if (isset($_SESSION['signup_data'])) {

        // Obtener los datos del primer formulario desde la sesión
        $signup_data = $_SESSION['signup_data'];

        

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (usuario, nombre, email,  password ) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Registro</title>
    <link rel="stylesheet" href="../css/signUp.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    <script>
        // Redirigir a login.html después de 3 segundos
        setTimeout(function(){
            window.location.href = '../html/signUp.html';
        }, 3000);
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <h2><?php echo $mensaje; ?></h2>
        </div>
    </div>
</body>
</html>
