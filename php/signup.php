<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Variable para el mensaje
$mensaje = "";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // corregido: usar guion bajo


    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }

    // Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $usuario);
    $stmt_check->execute();
    $resultado_check = $stmt_check->get_result();

    if ($resultado_check->num_rows > 0) {
        die("El nombre de usuario ya existe.");
    }

    // Insertar el nuevo usuario en la base de datos
    $sql_insert = "INSERT INTO usuarios (usuario, nombre, apellido, email, password) 
                   VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bind_param("sssss", $usuario, $nombre, $apellido, $email, $password);

    if ($stmt_insert->execute()) {
        // Registro exitoso
       header("location:../html/login.html");
       exit();
    } else {
        // Error al registrar
        $mensaje = "Error al registrar el usuario. Inténtalo de nuevo.";
    }

    // Cerrar las declaraciones
    $stmt_check->close();
    $stmt_insert->close();
    $conexion->close();
}
?>