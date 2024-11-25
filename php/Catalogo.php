<?php
session_start();
include 'conexion.php'; // Asegúrate de que el archivo de conexión a la base de datos sea correcto

// Verificar si el usuario ha iniciado sesión (solo para mostrar el botón de login o username)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Log In";
}

// Obtener el IDherramienta de la URL
$IDherramienta = isset($_GET['IDherramienta']) ? $_GET['IDherramienta'] : null;

if ($IDherramienta) {
    // Consultar los detalles de la herramienta con el ID proporcionado
    $sql_herramienta = "SELECT * FROM herramientas WHERE IDherramienta = ?";
    if ($stmt = $conexion->prepare($sql_herramienta)) {
        $stmt->bind_param("i", $IDherramienta);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $herramienta = $resultado->fetch_assoc();
        
        if ($herramienta === null) {
            echo "Herramienta no encontrada.";
            exit();
        }

        // Consultar el nombre del propietario de la herramienta
        $IDusuario = $herramienta['IDusuario'];
        $sql_usuario = "SELECT nombre FROM usuarios WHERE ID = ?";
        if ($stmt_usuario = $conexion->prepare($sql_usuario)) {
            $stmt_usuario->bind_param("i", $IDusuario);
            $stmt_usuario->execute();
            $resultado_usuario = $stmt_usuario->get_result();
            $usuario = $resultado_usuario->fetch_assoc();
            
            // Si el usuario existe, mostramos su nombre, si no, mostramos un mensaje de propietario desconocido
            $nombre_usuario = $usuario ? $usuario['nombre'] : 'Propietario desconocido';
        } else {
            // Error al preparar la consulta del usuario
            echo "Error en la consulta del propietario: " . $conexion->error;
            exit();
        }
    } else {
        // Error al preparar la consulta de la herramienta
        echo "Error en la consulta de la herramienta: " . $conexion->error;
        exit();
    }
} else {
    echo "No se ha especificado una herramienta.";
    exit();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>



<!-- AQUI COMIENZA EL HEADER --> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Prest-AR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Bootstrap  -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dropdown.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="/css/owl.carousel.css">
	<link rel="stylesheet" href="/css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="/css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/catalogo.css">

</head>

<body>


	<div id="page-wrap">
	
	
	  <!--==========================================================================================================
														   HERO
			 ========================================================================================================== -->
	
		<div id="fh5co-hero-wrapper">
		<nav class="container navbar navbar-expand-lg main-navbar-nav navbar-light">
			<a class="navbar-brand" href="index.php">Prest-AR</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav nav-items-center ml-auto mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="add_herramienta.php" onclick="$('#fh5co-features').goTo();return false;">Subir Herramienta<span class="sr-only">(current)</span></a>
					</li>
                        <li class="nav-item dropdown">
    <a class="nav-link" href="#" id="dropdownMenu" onclick="toggleDropdown(); return false;"><?php echo $username; ?></a>
    <ul class="dropdown-menu">
        <li><a href="../php/editperfil.php">Editar Perfil</a></li>
        <li><a href="../php/MisAlquileres.php">Mis Alquileres</a></li>
        <li><a href="../php/misarticulos.php">Mis Articulos</a></li>
        <li><a href="../php/cerrarsesion.php">Cerrar sesión</a></li>
    </ul>
</li>
					<div class="social-icons-header">
						<a href="https://www.facebook.com/fh5co"><i class="fab fa-facebook-f"></i></a>
						<a href="https://freehtml5.co"><i class="fab fa-instagram"></i></a>
						<a href="https://www.twitter.com/fh5co"><i class="fab fa-twitter"></i></a>
					</div>
				</div>
			</nav>
            <script>
        function toggleDropdown() {
    const dropdownMenu = document.querySelector('.dropdown-menu');
    const isVisible = dropdownMenu.style.display === 'block';

    // Oculta todos los menús desplegables
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
    });

    // Si el menú no estaba visible, lo mostramos
    if (!isVisible) {
        dropdownMenu.style.display = 'block';
    }
}

// Cierra el dropdown si se hace clic fuera de él
document.addEventListener('click', function(event) {
    const target = event.target;
    if (!target.closest('.nav-item.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});
</script>
<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #f4f4f4;
				margin: 0;
				padding: 0;
			}
	
			.catalogo {
				display: flex;
				flex-wrap: wrap;
				justify-content: center;
				margin: 20px;
			}
	
			.infobox {
				background-color: white;
				border: 1px solid #ddd;
				border-radius: 8px;
				padding: 15px;
				margin: 10px;
				width: 800px;
				box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
				text-align: center;
			}
	
			.infobox img {
				max-width: 100%;
				height: auto;
				border-bottom: 1px solid #ddd;
				padding-bottom: 10px;
			}
	
			.infobox h2 {
				font-size: 1.5em;
				margin: 10px 0;
			}
	
			.infobox p {
				font-size: 1em;
				color: #555;
				margin: 5px 0;
			}
	
			.infobox .precio {
				font-size: 1.2em;
				font-weight: bold;
				color: #e74c3c;
				margin: 10px 0;
			}
	
			.infobox button {
				background-color: #3498db;
				color: white;
				padding: 10px;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				font-size: 1em;
				transition: background-color 0.3s ease;
			}
	
			.infobox button:hover {
				background-color: #2980b9;
			}
		</style>
		</div>
    

        <!-- AQUI TERMINA EL HEADER -->
		
		<body>
    
    <br><br>
    <div class="catalogo">
    <div class="infobox">
        <h1><?php echo htmlspecialchars($herramienta['nombreherramienta']); ?></h1>
        <br><br>
        <div class="carousel-container">
            <a class="prev" onclick="changeImage(-1)">&#10094;</a>
            <div class="image-container">
                <img id="image-display" src="<?php echo htmlspecialchars($herramienta['imagenes']); ?>" 
                     alt="<?php echo htmlspecialchars($herramienta['nombreherramienta']); ?>">
            </div>
            <a class="next" onclick="changeImage(1)">&#10095;</a>
        </div>
        <br><br><br>
        <p><b>Descripción:</b> <?php echo htmlspecialchars($herramienta['descripcion']); ?></p>
        <br>
        <p><b>Propietario:</b> <?php echo htmlspecialchars($nombre_usuario); ?></p>
        <br>
        <p><b>Precio por Hora:</b> $<?php echo htmlspecialchars($herramienta['precio_hora']); ?></p>
        <p><b>Precio por Día:</b> $<?php echo htmlspecialchars($herramienta['precio_dia']); ?></p>
        <p><b>Precio por Semana:</b> $<?php echo htmlspecialchars($herramienta['precio_semana']); ?></p>
        <p><b>Categoría:</b> <?php echo htmlspecialchars($herramienta['categoria']); ?></p>
        <br>

        <!-- Formulario para reservar -->
        <div class="reservation-form">
            <form action="ConfirmacionAlquiler.php" method="POST">
                <!-- Campo oculto para IDherramienta -->
                <input type="hidden" name="IDherramienta" value="<?php echo htmlspecialchars($herramienta['IDherramienta']); ?>">

                <!-- Input para la fecha -->
                <label for="fecha_reserva">Selecciona la fecha:</label>
                <input type="date" id="fecha_reserva" name="fecha_reserva" required>

                <!-- Input para la hora -->
                <label for="hora_reserva">Selecciona la hora:</label>
                <input type="time" id="hora_reserva" name="hora_reserva" required>

                <!-- Botón para confirmar la reserva -->
                <button type="submit">Alquilar</button>
            </form>
        </div>
        <br><br>
    </div>
</div>



			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<footer class="footer-outer">
				<div class="container footer-inner">
		
					<div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.66s">
						<div class="column-1-3">
							<h1>Prest-AR</h1>
						</div>
						<div class="column-2-3">
							<nav class="footer-nav">
								<ul>
									<a href="../index.html" onclick="$('#fh5co-hero-wrapper').goTo();return false;"><li>Inicio</li></a>
									<!-- <a href="#" onclick="$('#fh5co-features').goTo();return false;"><li>Features</li></a> -->
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
		
					<p class="copyright">&copy; 2024 App. All rights reserved.</p>
		
				</div>
			</footer>


			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.js"></script>
			<script src="js/owl.carousel.js"></script>
			<script src="js/wow.min.js"></script>
			<script src="js/main.js"></script>

			<script>
				// Arreglo de URLs de las imágenes
				const images = [
				  'https://via.placeholder.com/500x300/0000FF/808080?text=Imagen+1',
				  'https://via.placeholder.com/500x300/FF0000/FFFFFF?text=Imagen+2',
				  'https://via.placeholder.com/500x300/00FF00/000000?text=Imagen+3'
				];
			  
				// Índice inicial de la imagen
				let currentIndex = 0;
			  
				// Función para cambiar de imagen
				function changeImage(direction) {
				  currentIndex += direction;
			  
				  // Si el índice es mayor o menor que las imágenes disponibles, se reinicia
				  if (currentIndex >= images.length) {
					currentIndex = 0;
				  } else if (currentIndex < 0) {
					currentIndex = images.length - 1;
				  }
			  
				  // Actualizar la imagen mostrada
				  document.getElementById('image-display').src = images[currentIndex];
				}
			  </script>
				<script>
					// Función para realizar la reserva
					function makeReservation() {
					  // Obtener los valores de fecha y hora
					  const date = document.getElementById('reservation-date').value;
					  const time = document.getElementById('reservation-time').value;
				  
					  // Validar que ambos campos estén llenos
					  if (date === '' || time === '') {
						alert('Por favor, selecciona una fecha y una hora.');
						return;
					  }
				  
					  // Crear mensaje de confirmación
					  const confirmationMessage = `Reserva realizada para el ${date} a las ${time}.`;
					  
					  // Mostrar el mensaje de confirmación en el HTML
					  document.getElementById('confirmation-message').textContent = confirmationMessage;
				  
					  // Aquí podrías agregar lógica para enviar la reserva al servidor
					  // por ejemplo, mediante una solicitud AJAX o fetch
					}
				  </script>
		
		</body>
	
		</html>
		<?php

/*session_start();
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

// Preparar la consulta para insertar en la tabla carrito
$sql = "INSERT INTO carrito (usuario, nombre, apellido, email, telefono, direccion, horas, experiencia, informacion, fecha_reserva, hora_reserva, fecha_creacion) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssssss", $username, $nombre, $apellido, $email, $telefono, $direccion, $horas, $experiencia, $informacion, $date, $time);

if ($stmt->execute()) {
    ;
} else {
     $conexion->error;
}

$stmt->close();

$conexion->close();*/
?>

