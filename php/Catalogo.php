<?php
// Iniciar la sesión
session_start();
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Log In";
}

// Obtener el ID de la herramienta desde la URL
$id_herramienta = $_GET['id'] ?? null; // Cambiar 'ID' por 'id'

if ($id_herramienta === null) {
    echo "Error: ID de herramienta no proporcionado.";
    exit;
}

// Conectar a la base de datos (asegúrate de que $conexion esté definido)
// $conexion = new mysqli(...); // Agrega tu conexión aquí

// Consultar la herramienta
$sql = "SELECT * FROM herramientas WHERE ID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_herramienta);
$stmt->execute();
$resultado = $stmt->get_result();
$herramienta = $resultado->fetch_assoc();

if ($herramienta) {
    // Aquí puedes continuar con el resto de tu lógica,
    // como mostrar los detalles de la herramienta.
} else {
    echo "Error: Herramienta no encontrada.";
    exit;
}
?>



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
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/Catalogo.css">

</head>

<body>


	<div id="page-wrap">
	
	
	  <!--==========================================================================================================
														   HERO
			 ========================================================================================================== -->
	
		<div id="fh5co-hero-wrapper">
			<nav class="container navbar navbar-expand-lg main-navbar-nav navbar-light">
				<a class="navbar-brand" href="">Prest-AR</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
	
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav nav-items-center ml-auto mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="../index.html">Inicio <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../ProyectoFinal2024-main/html/Catalogo.html" onclick="$('#fh5co-features').goTo();return false;">Herramientas</a>
						</li>
						 <li class="nav-item">
							<a class="nav-link" href="#" onclick="$('#fh5co-reviews').goTo();return false;">Reviews</a>
						</li> 
						<li class="nav-item">
							<a class="nav-link" href="../html/logIn.html" ><?php echo $username; ?></a>
						</li>
					</ul>
					<div class="social-icons-header">
						<a href="https://www.facebook.com/fh5co"><i class="fab fa-facebook-f"></i></a>
						<a href="https://freehtml5.co"><i class="fab fa-instagram"></i></a>
						<a href="https://www.twitter.com/fh5co"><i class="fab fa-twitter"></i></a>
					</div>
				</div>
			</nav>

		</div>
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
		<br>
		<br>
		<br>
		<body>
			<h1 style="text-align: center;">Catálogo de Herramientas para Alquilar</h1>
			<br>
			<br>
		
			<div class="catalogo">
    <div class="infobox">
	<h2><?php echo $herramienta['nombreherramienta']; ?></h2>
        <br>
        <br>
        <div class="carousel-container">
            <a class="prev" onclick="changeImage(-1)">&#10094;</a>
            <div class="image-container">
			<img id="image-display" src="<?php echo $herramienta['imagenes']; ?>" alt="<?php echo $herramienta['nombreherramienta']; ?>">
            </div>
            <a class="next" onclick="changeImage(1)">&#10095;</a>
        </div>
        <br>
        <br>
        <br>
        <p><b>Descripción:</b> <?php echo $herramienta['descripcion']; ?></p>
        <br>
        <p><b>Propietario:</b> <?php echo $herramienta['propietario']; ?></p>
        <br>
        <p><b>Precio por Hora:</b> $<?php echo $herramienta['precio_hora']; ?></p>
				<p><b>Precio por Día:</b> $<?php echo $herramienta['precio_dia']; ?></p>
				<p><b>Precio por Semana:</b> $<?php echo $herramienta['precio_semana']; ?></p>
				<p><b>Categoría:</b> <?php echo $herramienta['categoria']; ?></p>
        <br>

					<div class="reservation-form">
					<form action="ConfirmacionAlquiler.php" method="POST">
						<br>
						<br>

					  
						<!-- Input para la fecha -->
						<label for="reservation-date">Selecciona la fecha:</label>
						<input type="date" id="reservation-date" name="reservation-date" required>
					  
						<!-- Input para la hora -->
						<label for="reservation-time">Selecciona la hora:</label>
						<input type="time" id="reservation-time" name="reservation-time" required>
					  
						<!-- Botón para confirmar la reserva -->
						<button onclick="makeReservation()"><a href="ConfirmacionAlquiler.php">Alquilar</button>
						
						<!-- Mensaje de confirmación -->
						<p id="confirmation-message"></p>
						</form>
					</div>
					<br>
					<br>
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
