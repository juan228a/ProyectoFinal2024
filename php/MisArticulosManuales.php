<?php
// Iniciar la sesión
session_start();
include 'conexion.php'; // Asegúrate de que el archivo de conexión a la base de datos sea correcto

// Verificar si el usuario ha iniciado sesión (solo para mostrar el botón de login o username)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Log In/Sign Up";
}

// Obtener todas las herramientas de la categoría "electrodomésticos" que no están en el carrito
$sql_herramientas = "
    SELECT * 
    FROM herramientas 
	WHERE tipo_herramienta = 'manual' 
    AND IDherramienta NOT IN (
        SELECT IDherramienta 
        FROM carrito
    )
";
$resultado_herramientas = $conexion->query($sql_herramientas);

if ($resultado_herramientas === false) {
    die("Error en la consulta de herramientas: " . $conexion->error);
}

$herramientas = $resultado_herramientas->fetch_all(MYSQLI_ASSOC);

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
	<link rel="stylesheet" href="../css/MisArticulos.css">

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
		</div>
    

        <!-- AQUI TERMINA EL HEADER -->

	   </div>
   
	 </div>

	<br>
	<br>

    <div class="main-container">
    <div class="button-container">
   <div class="text-center">
            <a href="MisArticulosElectricos.php"><button type="submit" class="btn btn-secondary custom-button">Electricas</button>
			</a></div>
        </div>

        <div class="button-container2">
        <div class="text-center">
           <a href="MisArticulos.php"><button type="submit" class="btn btn-secondary custom-button">Todas las herramientas</button></a> 
        </div>
        </div>
		
       <!-- <div class="button-container3">
        <div class="text-center">
           <a href="MisArticulosManuales.php"><button type="submit" class="btn btn-secondary custom-button">Manuales</button></a> 
        </div>
    </div>--->
    </div>


	<br>
	<br>

	<hr>
	<div class="catalogo"> 
    <?php if (!empty($herramientas)): ?>
        <?php foreach ($herramientas as $index => $herramienta): ?>
            <div class="infobox">
                <!-- Mostrar la imagen de la herramienta -->
                <img class="imagen-herramienta" src="<?php echo $herramienta['imagenes']; ?>" alt="<?php echo $herramienta['nombreherramienta']; ?>">
                
                <!-- Mostrar el nombre de la herramienta -->
                <h1><?php echo $herramienta['nombreherramienta']; ?></h1>
                
                <!-- Mostrar la marca -->
                <h5><b>Marca:</b> <?php echo $herramienta['marca_herramienta']; ?></h5>

				<h5><b>Cantidad Disponibles:</b> <?php echo $herramienta['cantidad_herramienta']; ?></h5>

                <!-- Botón "Ver más" -->
                <div class="content-container">
                    <button class="btn btn-secondary toggle-button" onclick="toggleContent(<?php echo $index; ?>)">
                        Ver más
                    </button>

                    <!-- Contenido adicional oculto -->
                    <div class="hidden-content" id="extraContent-<?php echo $index; ?>">
                        <p><b>Descripción:</b></p>
                        <p><?php echo $herramienta['descripcion']; ?></p>
                        
                        <p class="precio">Precio por hora: $<?php echo $herramienta['precio_hora']; ?></p>
                        <p class="precio">Precio por día: $<?php echo $herramienta['precio_dia']; ?></p>
                        <p class="precio">Precio por semana: $<?php echo $herramienta['precio_semana']; ?></p>
                        
                        <form action="Catalogo.php?IDherramienta=<?php echo $herramienta['IDherramienta']; ?>" method="POST">
                            <input type="hidden" name="IDherramienta" value="<?php echo $herramienta['IDherramienta']; ?>">
                            <button type="submit" class="btn btn-primary">Alquilar</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay herramientas disponibles en este momento.</p>
    <?php endif; ?>
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
			<script src="../js/main.js"></script>
			<script src="../js/jquery.min.js"></script>
			<script src="../js/bootstrap.js"></script>
			<script src="../js/owl.carousel.js"></script>
			<script src="../js/wow.min.js"></script>

			<script> 
			function toggleContent(index) {
    		const content = document.getElementById(`extraContent-${index}`);
    		const button = content.previousElementSibling;

    		if (content.style.display === 'none' || content.style.display === '') {
        	content.style.display = 'block'; // Muestra el contenido
        	button.textContent = 'Ver menos'; // Cambia el texto del botón
    		} else {
        	content.style.display = 'none'; // Oculta el contenido
        	button.textContent = 'Ver más'; // Cambia el texto del botón
    		}
			}
			</script>
			</body>

            </html>
