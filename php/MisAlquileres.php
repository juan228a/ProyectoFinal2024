<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Prest-AR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

	<!-- Bootstrap -->
	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="../css/Catalogo.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" crossorigin="anonymous">

	<style>
		/* Estilo específico para las herramientas alquiladas */
		.alquiler-card {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color: #fff;
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 15px;
			margin: 10px 0;
			box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		}

		.alquiler-card img {
			width: 120px;
			height: auto;
			border-radius: 8px;
		}

		.alquiler-details {
			flex: 1;
			margin-left: 20px;
		}

		.alquiler-details h5 {
			font-size: 1.2em;
			margin-bottom: 10px;
		}

		.alquiler-details p {
			margin: 5px 0;
			color: #555;
		}

		.alquiler-actions {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: flex-end;
		}

		.alquiler-actions button {
			background-color: #3498db;
			color: white;
			padding: 10px 15px;
			border: none;
			border-radius: 5px;
			margin-bottom: 5px;
			cursor: pointer;
			font-size: 1em;
			transition: background-color 0.3s ease;
		}

		.alquiler-actions button:hover {
			background-color: #2980b9;
		}
	</style>
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
		<!-- Herramientas alquiladas -->
		<div class="container">
			<div class="alquiler-card">
				<img src="ruta_de_la_imagen.jpg" alt="Imagen de la herramienta">
				<div class="alquiler-details">
					<h5>Taladro Eléctrico</h5>
					<p><strong>Descripción:</strong> Taladro eléctrico de 500W, ideal para trabajos de construcción.</p>
					<p><strong>Dueño:</strong> Carlos Moreno</p>
					<p><strong>Fecha de alquiler:</strong> 15/11/2024</p>
					<p><strong>Días pendientes:</strong> 3 días</p>
				</div>
				<div class="alquiler-actions">
					<button>Ver Compra</button>
					<button>Volver a alquilar</button>
				</div>
			</div>

			<div class="alquiler-card">
				<img src="ruta_de_la_imagen_2.jpg" alt="Imagen de la herramienta">
				<div class="alquiler-details">
					<h5>Llave Stilson</h5>
					<p><strong>Descripción:</strong> Llave ajustable para plomería, resistente y duradera.</p>
					<p><strong>Dueño:</strong> Nahuel Bardera</p>
					<p><strong>Fecha de alquiler:</strong> 10/11/2024</p>
					<p><strong>Días pendientes:</strong> 5 días</p>
				</div>
				<div class="alquiler-actions">
					<button>Ver Compra</button>
					<button>Volver a alquilar</button>
				</div>
			</div>
		</div>
		<br><br><br><br><br><br><br><br><br>
		<!-- FOOTER -->
		 /
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

	<!-- JavaScript -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/owl.carousel.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/main.js"></script>


</body>
</html>
