<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Inicializar variables para almacenar los datos del usuario y la herramienta
$usuario = $nombre = $apellido = $email = $telefono = $provincia = $ciudad = $codigopostal = $dni = $descripcion = "";
$IDherramienta = $nombreherramienta = $descripcionherramienta = $imagenes = $nombrepropietario = "";
$precio_hora = $precio_dia = $precio_semana = $cantidad_herramienta = "";

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Recuperar los datos del usuario de la base de datos
    $sql_usuario = "SELECT usuario, nombre, apellido, email, telefono, provincia, ciudad, codigopostal, dni, descripcion FROM usuarios WHERE usuario = ?";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bind_param("s", $username);
    $stmt_usuario->execute();
    $stmt_usuario->bind_result($usuario, $nombre, $apellido, $email, $telefono, $provincia, $ciudad, $codigopostal, $dni, $descripcion);
    $stmt_usuario->fetch();
    $stmt_usuario->close();
} else {
    // Si no ha iniciado sesión, redirigir a la página de login
    header("Location: ../html/login.html");
    exit();
}

// Verificar si se recibió el IDherramienta desde el formulario
if (isset($_GET['IDherramienta'])) {
    $IDherramienta = $_GET['IDherramienta'];

    // Recuperar los datos de la herramienta seleccionada
    $sql_herramienta = "
        SELECT h.nombreherramienta, h.descripcion, h.imagenes, h.precio_hora, h.precio_dia, h.precio_semana, h.cantidad_herramienta, u.nombre AS propietario
        FROM herramientas h
        INNER JOIN usuarios u ON h.IDusuario = u.ID
        WHERE h.IDherramienta = ?";
    $stmt_herramienta = $conexion->prepare($sql_herramienta);
    $stmt_herramienta->bind_param("i", $IDherramienta);
    $stmt_herramienta->execute();
    $stmt_herramienta->bind_result(
        $nombreherramienta,
        $descripcionherramienta,
        $imagenes,
        $precio_hora,
        $precio_dia,
        $precio_semana,
        $cantidad_herramienta,
        $nombrepropietario
    );
    $stmt_herramienta->fetch();
    $stmt_herramienta->close();
} else {
    echo "No se ha especificado una herramienta para editar.";
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
	<link rel="stylesheet" href="../css/EditPerfil.css">

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
        <li><a href="../php/MisHerramientas.php">Mis Herramientas</a></li>
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

        <!-- ==========================================================================================================
                                               Perfil de usuario
    ========================================================================================================== -->


    <div class="container"></div>
    <br>
    <br>
    <div class="profile-container mx-auto">
        <h2 class="text-center mb-4"><u>Editar Herramienta</u></h2>
        <hr>
        <br>
        <div class="centrarform">
        <div class="container">
    
    <form action="actualizar_herramienta_admin.php" method="POST" enctype="multipart/form-data">
    <!-- Mostrar datos de la herramienta -->
    <div class="form-group">
        <label for="nombreherramienta">Nombre de la Herramienta:</label>
        <input type="text" class="form-control" id="nombreherramienta" name="nombreherramienta" value="<?php echo htmlspecialchars($nombreherramienta); ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($descripcionherramienta); ?></textarea>
    </div>
    <div class="form-group">
        <label for="nombrepropietario">Nombre del Propietario:</label>
        <input type="text" class="form-control" id="nombrepropietario" name="nombrepropietario" value="<?php echo htmlspecialchars($nombrepropietario); ?>" readonly>
    </div>
    <div class="form-group">
        <label for="precio_hora">Precio por Hora:</label>
        <input type="number" class="form-control" id="precio_hora" name="precio_hora" value="<?php echo htmlspecialchars($precio_hora); ?>" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="precio_dia">Precio por Día:</label>
        <input type="number" class="form-control" id="precio_dia" name="precio_dia" value="<?php echo htmlspecialchars($precio_dia); ?>" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="precio_semana">Precio por Semana:</label>
        <input type="number" class="form-control" id="precio_semana" name="precio_semana" value="<?php echo htmlspecialchars($precio_semana); ?>" step="0.01" required>
    </div>

    <div class="input-group">
                    <label for="cantidad_herramienta">Cantidad</label>
                    <input type="number" id="cantidad_herramienta" name="cantidad_herramienta" value="<?php echo htmlspecialchars ($cantidad_herramienta); ?>" required>
                </div>


    <div class="form-group">
        <label for="imagenes">Imagen Actual:</label>
        <div>
            <img src="<?php echo htmlspecialchars($imagenes); ?>" alt="Imagen de la herramienta"  style="max-width: 200px; max-height: 150px; height: auto; width: auto;">
        </div>
        <label for="imagenes">Cambiar Imagen:</label>
        <input type="file" class="form-control" id="imagenes" name="imagenes">
    </div>

    <!-- Campo oculto para pasar el IDherramienta y la imagen actual -->
    <input type="hidden" name="IDherramienta" value="<?php echo htmlspecialchars($IDherramienta); ?>">
    <input type="hidden" name="imagenes_actual" value="<?php echo htmlspecialchars($imagenes); ?>">

    <!-- Botones de acción -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="AdministrarHerramienta.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
</div>

</div>

</div>




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
    	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/owl.carousel.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/main.js"></script>
        </body>
        </html>