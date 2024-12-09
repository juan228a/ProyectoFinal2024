<?php
// Iniciar la sesión
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Obtener el ID del usuario logueado
    $sql_usuario = "SELECT ID FROM usuarios WHERE usuario = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    if (!$stmt_usuario) {
        die("Error en la preparación de la consulta de usuario: " . $conexion->error);
    }
    $stmt_usuario->bind_param("s", $username);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();
    $usuario = $resultado_usuario->fetch_assoc();
    $IDusuario = $usuario['ID'];

    // Consultar los alquileres del usuario actual en la tabla carrito
    $sql_alquiler = "
        SELECT carrito.IDherramienta, carrito.fecha_reserva, carrito.hora_reserva, 
               herramientas.nombreherramienta, herramientas.descripcion, herramientas.imagenes,
               usuarios.usuario AS nombre, usuarios.apellido
        FROM carrito
        JOIN herramientas ON carrito.IDherramienta = herramientas.IDherramienta
        JOIN usuarios ON herramientas.IDusuario = usuarios.ID
        WHERE carrito.IDusuario = ?";
    
    $stmt_alquiler = $conexion->prepare($sql_alquiler);
    if (!$stmt_alquiler) {
        die("Error en la preparación de la consulta de alquiler: " . $conexion->error);
    }

    $stmt_alquiler->bind_param("i", $IDusuario);
    $stmt_alquiler->execute();
    $resultado_alquiler = $stmt_alquiler->get_result();
    $alquileres = $resultado_alquiler->fetch_all(MYSQLI_ASSOC);

    $stmt_usuario->close();
    $stmt_alquiler->close();
    $conexion->close();
} else {
    // Redirigir al usuario al inicio de sesión si no está logueado
    header("Location: index.php");
    exit();
}
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
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style  -->
	
	<link rel="stylesheet" href="../css/EditPerfil.css">
	<link rel="stylesheet" href="../css/misAlquileres.css">

	
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
						<a class="nav-link" href="add_herramienta.php">Subir Herramienta<span class="sr-only">(current)</span></a>
					</li>
                        <li class="nav-item dropdown">
    <a class="nav-link" href="#" id="dropdownMenu" onclick="toggleDropdown(); return false;"><?php echo $username; ?></a>
    <ul class="dropdown-menu">
        <li><a href="editperfil.php">Editar Perfil</a></li>
        <li><a href="MisAlquileres.php">Mis Alquileres</a></li>
        <li><a href="MisHerramientas.php">Mis Herramientas</a></li>
        <li><a href="cerrarsesion.php">Cerrar sesión</a></li>
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

	<!-- Lista de herramientas alquiladas -->
	<div class="container">
    <?php if (!empty($alquileres)): ?>
        <?php foreach ($alquileres as $alquiler): ?>
            <div class="alquiler-card">
                <img src="<?php echo $alquiler['imagenes']; ?>" alt="Imagen de <?php echo $alquiler['nombreherramienta']; ?>">
                <div class="alquiler-details">
                    <h5><?php echo $alquiler['nombreherramienta']; ?></h5>
                    <p><strong>Descripción:</strong> <?php echo $alquiler['descripcion']; ?></p>
                    <p><strong>Dueño:</strong> <?php echo $alquiler['nombre'] ?? 'Nombre desconocido'; ?> <?php echo $alquiler['apellido'] ?? ''; ?></p>
                    <p><strong>Fecha de alquiler:</strong> <?php echo $alquiler['fecha_reserva'] != '0000-00-00' ? $alquiler['fecha_reserva'] : 'Fecha desconocida'; ?></p>
                    <p><strong>Días pendientes:</strong> <?php echo isset($alquiler['hora_reserva']) ? $alquiler['hora_reserva'] : 'Desconocido'; ?> días</p>
                </div>
                <div class="alquiler-actions">
                    <button>Ver Compra</button>
                    <button>Volver a alquilar</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tienes herramientas alquiladas.</p>
    <?php endif; ?>
</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
								<a href="index.php" ><li>Inicio</li></a>
								<!-- <a href="#" onclick="$('#fh5co-features').goTo();return false;"><li>Features</li></a> -->
								<a href="terminosycondiciones.php" ><li>Terminos Y Condiciones</li></a>
								<a href="privacidad.php"><li>Privacidad</li></a>
								
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
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/owl.carousel.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/main.js"></script>


</body>
</html>
