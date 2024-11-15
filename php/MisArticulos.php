<?php
// Iniciar la sesión para almacenar los datos temporalmente
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Inicializar variables para almacenar los datos del usuario
$herramientas = [];

// Recuperar todos los datos de la tabla herramientas
$sql = "SELECT ID, propietario, nombreherramienta, descripcion, precio_hora, precio_dia, precio_semana, categoria, imagenes FROM herramientas";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$resultado = $stmt->get_result();

// Guardar todas las herramientas en un array
while ($fila = $resultado->fetch_assoc()) {
    $herramientas[] = $fila;
}

$stmt->close();
$conexion->close();
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
	<link rel="stylesheet" href="../css/MisArticulos.css">

</head>
<body>


<div id="page-wrap">


	<!-- ==========================================================================================================
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
						<a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../ProyectoFinalGithub/ProyectoFinalGithub/html/ConfirmacionAlquiler.html" onclick="$('#fh5co-features').goTo();return false;">Herramientas</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="#" onclick="$('#fh5co-reviews').goTo();return false;">Reviews</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="../html/logIn.html" >Login/SignUp</a>
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


<br>
<br>

	   </div>
   
	 </div>

    <br>
	<br>
	<br>
	<hr>

    <div class="catalogo">
    <?php foreach ($herramientas as $herramienta): ?>
    <div class="infobox">
        <!-- Mostrar la imagen de la herramienta -->
        <img class="imagen-herramienta" src="<?php echo $herramienta['imagenes']; ?>" alt="<?php echo $herramienta['nombreherramienta']; ?>">
        
        <!-- Mostrar el nombre de la herramienta -->
        <h2><?php echo $herramienta['nombreherramienta']; ?></h2>
        
        <!-- Mostrar la descripción de la herramienta -->
        <p><?php echo $herramienta['descripcion']; ?></p>
        
        <!-- Mostrar los precios (hora, día, semana) -->
        <p class="precio">Precio por hora: $<?php echo $herramienta['precio_hora']; ?></p>
        <p class="precio">Precio por día: $<?php echo $herramienta['precio_dia']; ?></p>
        <p class="precio">Precio por semana: $<?php echo $herramienta['precio_semana']; ?></p>
        
        <!-- Formulario para alquilar -->
        <form action="catalogo.php?id=<?php echo $herramienta['ID']; ?>" method="POST">
           
          
            <button type="submit">Alquilar</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>



<br>






    







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

			<script src="../js/mainjs.js"></script>

			</body>

            </html>
