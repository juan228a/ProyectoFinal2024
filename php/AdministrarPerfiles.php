<?php
// Iniciar la sesión
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Obtener todos los usuarios excepto el usuario con ID = 1
$sql_usuarios = "SELECT ID, usuario, nombre, apellido, DNI, email FROM usuarios WHERE ID != 1";
$resultado = $conexion->query($sql_usuarios);

if ($resultado === false) {
    die("Error en la consulta de usuarios: " . $conexion->error);
}

$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);

// Cerrar la conexión a la base de datos
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

	<!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dropdown.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style -->
	<link rel="stylesheet" href="../css/EditPerfil.css">

	<style>
		/* Estilos específicos para las tarjetas de usuarios */
		.user-card {
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

		.user-card img {
			width: 120px;
			height: auto;
			border-radius: 8px;
		}

		.user-details {
			flex: 1;
			margin-left: 20px;
		}

		.user-details h5 {
			font-size: 1.2em;
			margin-bottom: 10px;
		}

		.user-details p {
			margin: 5px 0;
			color: #555;
		}

		.user-actions {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: flex-end;
		}

		.user-actions a, .user-actions button {
			background-color: #3498db;
			color: white;
			text-decoration: none;
			text-align: center;
			padding: 10px 15px;
			border: none;
			border-radius: 5px;
			margin-bottom: 5px;
			cursor: pointer;
			font-size: 1em;
			transition: background-color 0.3s ease;
		}

		.user-actions a:hover, .user-actions button:hover {
			background-color: #2980b9;
		}

		/* Ajustes para hacer el contenido responsivo */
		@media (max-width: 768px) {
			.user-card {
				flex-direction: column;
				text-align: center;
			}

			.user-card img {
				max-width: 100px;
				margin-bottom: 15px;
			}

			.user-details {
				margin-left: 0;
				padding: 0;
			}

			.user-actions {
				align-items: center;
				margin-top: 10px;
			}
		}
	</style>
</head>

<body>
<div id="page-wrap">

	<!-- HEADER -->
	<div id="fh5co-hero-wrapper">
		<nav class="container navbar navbar-expand-lg main-navbar-nav navbar-light">
			<a class="navbar-brand" href="#">Prest-AR</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav nav-items-center ml-auto mr-auto">
					
					<li class="nav-item">
						<a class="nav-link" href="AdministrarHerramienta.php">Administrar Herramientas</a>
					</li>
					
					<li>
						<a class="nav-link" href="cerrarsesion.php">Cerrar sesión</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>

	<!-- SECCIÓN DE ADMINISTRACIÓN DE USUARIOS -->
	<br>
	<h1 style="text-align: center;">Panel de Administración de Usuarios</h1>
	<br>

	<div class="container">
		<?php foreach ($usuarios as $usuario): ?>
			<div class="user-card">
			
				<div class="user-details">
					<p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario['usuario']); ?></p>
					<p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
					<p><strong>Apellido:</strong> <?php echo htmlspecialchars($usuario['apellido']); ?></p>
					<p><strong>DNI:</strong> <?php echo htmlspecialchars($usuario['DNI']); ?></p>
					<p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
				</div>
				<div class="user-actions">
					<a href="editar_usuario.php?ID=<?php echo $usuario['ID']; ?>">Editar Usuario</a>
					<form method="POST" action="eliminar_usuario.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
    <input type="hidden" name="ID" value="<?php echo $usuario['ID']; ?>">
    <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
</form>
				</div>
			</div>
		<?php endforeach; ?>
	</div>


	<!-- FOOTER -->
	<br><br><br>
	<footer class="footer-outer">
		<div class="container footer-inner">
			<div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.66s">
				<div class="column-1-3">
					<h1>Prest-AR</h1>
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
	<script>
		function toggleDropdown() {
			// Código para el dropdown
		}

		function confirmarEliminacion() {
			const confirmBox = document.createElement('div');
			confirmBox.style.position = 'fixed';
			confirmBox.style.top = '50%';
			confirmBox.style.left = '50%';
			confirmBox.style.transform = 'translate(-50%, -50%)';
			confirmBox.style.padding = '20px';
			confirmBox.style.backgroundColor = '#fff';
			confirmBox.style.boxShadow = '0 4px 8px rgba(0,0,0,0.1)';
			confirmBox.style.textAlign = 'center';
			confirmBox.style.zIndex = '1000';

			confirmBox.innerHTML = `
				<p>¿Eliminar Usuario?</p>
				<button style="background-color: #28a745; color: #fff; border: none; padding: 10px 20px; margin-right: 10px; cursor: pointer;" onclick="alert('Usuario eliminado.'); document.body.removeChild(this.parentElement)">Sí</button>
				<button style="background-color: #dc3545; color: #fff; border: none; padding: 10px 20px; cursor: pointer;" onclick="document.body.removeChild(this.parentElement)">No</button>
			`;

			document.body.appendChild(confirmBox);
		}
	</script>
</div>
</body>
</html>
