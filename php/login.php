<?php
// Incluir archivo de conexión
include 'conexion.php';

// Variable para el mensaje
$mensaje = "";

// Iniciar la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $usuario = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['password'] === $password) {
                $_SESSION['username'] = $fila['usuario'];
                $_SESSION['nombre'] = $fila['nombre'];
                $_SESSION['email'] = $fila['email'];
                $_SESSION['telefono'] = $fila['telefono'];
                $_SESSION['provincia'] = $fila['provincia'];
                $_SESSION['ciudad'] = $fila['ciudad'];

                $mensaje = "Inicio de sesión exitoso. ¡Bienvenido, " . htmlspecialchars($fila['usuario']) . "!";

                // Diferenciar usuarios para redirección
                $redirectURL = ($usuario === "admin" && $password === "1234") 
                    ? 'AdministrarPerfiles.php' 
                    : 'index.php';
            } else {
                $mensaje = "Contraseña incorrecta.";
                $redirectURL = "../html/login.html";
            }
        } else {
            $mensaje = "Usuario no encontrado.";
            $redirectURL =  "../html/login.html";
        }

        $stmt->close();
    } else {
        $mensaje = "Campos de usuario o contraseña no establecidos.";
        $redirectURL =  "../html/login.html";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="wrapper">
    <div class="form-wrapper sign-in">
      <h2><?php echo $mensaje; ?></h2>
    </div>
  </div>

  <?php if (isset($redirectURL)): ?>
  <script>
    // Redirigir después de 3 segundos
    setTimeout(function() {
      window.location.href = '<?php echo $redirectURL; ?>';
    }, 3000);
  </script>
  <?php endif; ?>
</body>
</html>
