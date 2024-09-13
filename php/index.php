<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Log In";
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
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/style.css">

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
						<a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="$('#fh5co-features').goTo();return false;">Herramientas</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="#" onclick="$('#fh5co-reviews').goTo();return false;">Reviews</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="../html/login.html" ><?php echo $username?></a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="cerrarsesion.php">Cerrar session</a>
					</li>
				</ul>
				<div class="social-icons-header">
					<a href="https://www.facebook.com/fh5co"><i class="fab fa-facebook-f"></i></a>
					<a href="https://freehtml5.co"><i class="fab fa-instagram"></i></a>
					<a href="https://www.twitter.com/fh5co"><i class="fab fa-twitter"></i></a>
				</div>
			</div>
		</nav>

		<div class="container fh5co-hero-inner">
			<h1 class="animated fadeIn wow" data-wow-delay="0.4s">Herramientas a tu Alcance: Alquila Fácilmente y Sin Complicaciones</h1>
			<p class="animated fadeIn wow" data-wow-delay="0.67s">¡Haz realidad tus proyectos con las herramientas adecuadas! </p>
			<button class="btn btn-md download-btn-first wow fadeInLeft animated" data-wow-delay="0.85s" onclick="$('#fh5co-download').goTo();return false;">Alquilar</button>
			<button class="btn btn-md features-btn-first animated fadeInLeft wow" data-wow-delay="0.95s" onclick="$('#fh5co-features').goTo();return false;">Catalogo</button>
			
		</div>


	</div> <!-- first section wrapper -->



	<!-- ==========================================================================================================
													  SLIDER
		 ========================================================================================================== -->

	<div class="fh5co-slider-outer wow fadeIn" data-wow-delay="0.36s">
		<h1>Prest-AR</h1>
		<small>Categorias</small>
		<div class="container fh5co-slider-inner">

			<div class="owl-carousel owl-theme">

				<div class="item"><img src="../img/Historia de Instagram Anuncio de Servicio Técnico de Aire Acondicionado Moderno Azul(1).png" alt="sddddsd"></div>
				<div class="item"><img src="../img/smartphone-2.png" alt=""></div>
				<div class="item"><img src="../img/iphone.png" alt=""></div>
				<div class="item"><img src="../img/smartphone-2.png" alt=""></div>


			</div>

		</div>
	</div>


	<!-- ==========================================================================================================
													  FEATURES
		 ========================================================================================================== -->

	<div class="curved-bg-div wow animated fadeIn" data-wow-delay="0.15s"></div>
	<div id="fh5co-features" class="fh5co-features-outer">
		<div class="container">

			<div class="row fh5co-features-grid-columns">

				<div class="col-sm-6 in-order-1 wow animated fadeInLeft" data-wow-delay="0.22s">
					<div class="col-sm-image-container">
						<img class="img-float-left" src="../img/reserva.png" alt="smartphone-1">
					</div>
				</div>

				<div class="col-sm-6 in-order-2 sm-6-content wow animated fadeInRight" data-wow-delay="0.22s">
					<h1>Reserva tu equipo!</h1>
					<p>  Con unos pocos clics, puedes revisar la disponibilidad de una amplia variedad de equipos, verificar las condiciones de alquiler, y confirmar la reserva de manera rápida y segura.  </p>
				</div>

				<div class="col-sm-6 in-order-3 sm-6-content wow animated fadeInLeft" data-wow-delay="0.22s">
					<h1>Recógelo en el punto establecido</h1>
					<p>Una vez que confirmes tu alquiler, solo tendrás que dirigirte al punto de recogida acordado en el horario seleccionado. Este proceso asegura que puedas obtener tus herramientas de manera rápida y sin complicaciones, con la garantía de que estarán listas para que comiences tu proyecto sin demoras.</p>
				</div>

				<div class="col-sm-6 in-order-4 wow animated fadeInRight" data-wow-delay="0.22s">
					<img class="img-float-right" src="../img/punto-de-encuentro.png" alt="smartphone-2">
				</div>

				<div class="col-sm-6 in-order-5 wow animated fadeInLeft" data-wow-delay="0.22s">
					<div class="col-sm-image-container">
						<img class="img-float-left" src="../img/devolver.png" alt="smartphone-3">
					</div>
				</div>
				<div class="col-sm-6 in-order-6 sm-6-content wow animated fadeInRight" data-wow-delay="0.22s">
					<h1>Regresar el producto</h1>
					<p> Una vez que hayas terminado de usar las herramientas, puedes devolverlas en el lugar y hora acordados. Después de la devolución, tendrás la opción de calificar al vendedor, evaluando aspectos como la calidad de la herramienta y la comunicación durante el alquiler.</p>
		
				</div>




			</div> <!-- row -->


		</div>
	</div>


	<!-- ==========================================================================================================
                                                 BOTTOM
    ========================================================================================================== -->

	<div id="fh5co-download" class="fh5co-bottom-outer">
		<div class="overlay">
			<div class="container fh5co-bottom-inner">
				<div class="row">
					<div class="col-sm-6">
						<h1>¿Aún tienes dudas?</h1>
						<p>Contacta con nosotros y te ayudaremos encantados.</p>
						<br>
						<button class="btn btn-md features-btn-first animated fadeInLeft wow"> <a class="boton_vinculo" href="./html/contacto.html">Contacto</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- ==========================================================================================================
                                               SECTION 7 - SUB FOOTER
    ========================================================================================================== -->

	<footer class="footer-outer">
		<div class="container footer-inner">

			<div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.66s">
				<div class="column-1-3">
					<h1>Prest-AR</h1>
				</div>
				<div class="column-2-3">
					<nav class="footer-nav">
						<ul>
							<a href="#" onclick="$('#fh5co-hero-wrapper').goTo();return false;"><li>Inicio</li></a>
							<!-- <a href="#" onclick="$('#fh5co-features').goTo();return false;"><li>Features</li></a> -->
							<a href="./html/terminos-y-condiciones.html" onclick="$('#fh5co-reviews').goTo();return false;"><li>Terminos Y Condiciones</li></a>
							<a href="./html/Privacidad.html" onclick="$('#fh5co-reviews').goTo();return false;"><li>Privacidad</li></a>
							
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




</div> <!-- main page wrapper -->
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>