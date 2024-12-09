<?php
// Iniciar la sesión
session_start();

// Incluir archivo de conexión
include 'conexion.php';

// Inicializar variables para almacenar los datos del usuario
$usuario = $nombre = $apellido = $email = $telefono = $provincia = $ciudad = $codigopostal = $dni = $descripcion = "";

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Recuperar los datos del usuario de la base de datos
    $sql = "SELECT usuario, nombre, apellido, email, telefono, provincia, ciudad, codigopostal, dni, descripcion FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($usuario, $nombre, $apellido, $email, $telefono, $provincia, $ciudad, $codigopostal, $dni, $descripcion);
    $stmt->fetch();
    $stmt->close();
} else {
    // Si no ha iniciado sesión, redirigir a la página de login
    header("Location: ../html/login.html");
    exit();
}

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
	<link rel="stylesheet" href="../css/owl.carousel.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
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
        <h2 class="text-center mb-4"><u>Editar perfil</u></h2>
        <hr>
        <br>
        <div class="centrarform">
        <form action="actualizar_perfil.php" method="post" enctype="multipart/form-data">

            <!-- Usuario -->
            <div class="mb-3">
                  <label for="usuario" class="form-label"><b>Usuario</b></label>
                <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            </div>
            <hr>

            <!-- Nombre -->
            <div class="mb-3">
                 <label for="nombre" class="form-label"><b>Nombre</b></label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese su Nombre" value="<?php echo htmlspecialchars($nombre); ?>">
            </div>
            <hr>
            <!-- Apellido -->
            <div class="mb-3">
                 <label for="apellido" class="form-label"><b>Apellido</b></label>
                <input type="text" class="form-control" name="apellido" placeholder="Ingrese su Apellido" value="<?php echo htmlspecialchars($apellido); ?>">
            </div>
            <hr>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label"><b>Email</b></label>
              <input type="text" class="form-control" name="email" placeholder="Ingrese su Email" value="<?php echo htmlspecialchars($email); ?>">
          </div>
          <hr>

          <!-- Descripcion -->
          <div class="mb-3">
            <label for="descripcion" class="form-label"><b>Descripcion</b></label>
          <input type="text" class="form-control" name="descripcion" placeholder="Ingrese su Descripcion" value="<?php echo htmlspecialchars($descripcion); ?>">
            </div>
            <hr>

            <!-- DNI -->
            <div class="mb-3">
            <label for="dni" class="form-label"><b>DNI</b></label>
            <input type="number" class="form-control" name="dni" placeholder="Ingrese su DNI" value="<?php echo htmlspecialchars($dni); ?>">
            </div>
            <hr>

            <!-- CP -->
            <div class="mb-3">
            <label for="cp" class="form-label"><b>Codigo Postal</b></label>
            <input type="number" class="form-control" name="codigopostal" placeholder="Ingrese su Codigo Postal" value="<?php echo htmlspecialchars($codigopostal); ?>">
            </div>
            <hr>

            <!-- Localidad -->
            <div class="mb-3">
                <label for="localidad" class="form-label"><b>Ciudad</b></label>
                <input type="text" class="form-control" name="ciudad" placeholder="Ingrese su Ciudad" value="<?php echo htmlspecialchars($ciudad); ?>">
            </div>
            <hr>
            <!-- Provincia -->
            <div class="mb-3">
                <label for="provincia" class="form-label"><b>Provincia</b></label>
                <select class="form-select" name="provincia">
                    <option selected>Seleccione su provincia</option>
                    <option value="Buenos Aires">Buenos Aires</option>
                    <option value="Córdoba">Córdoba</option>
                    <option value="Santa Fe">Santa Fe</option>
                    <option value="Mendoza">Mendoza</option>
                    <option value="Tucumán">Tucumán</option>
                    <option value="Tucumán">Formosa</option>
                    <option value="Tucumán">Salta</option>
                    <option value="Tucumán">Jujuy</option>
                    <option value="Tucumán">La rioja</option>
                    <!-- Puedes agregar más opciones según las provincias de tu país -->
                </select>
            </div>
            <hr>

            <!-- Número de Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label"><b>Número de Teléfono</b></label>
                <input type="tel" class="form-control" name="telefono" placeholder="Ingrese su número de teléfono" value="<?php echo htmlspecialchars($telefono); ?>">
            </div>
            <hr>
          

    

            <!-- Género -->
           <!---- <div class="mb-3">
                <label class="form-label"><b>Género</b></label>
                <hr>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre">
                        <label class="form-check-label" for="hombre">Hombre</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer">
                        <label class="form-check-label" for="mujer">Mujer</label>
                    </div>
                </div>
            </div>-->
            <!-- Botón de Enviar -->
             <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </form>
    </div>
</div>

</div>




        <br>
        <br>
        <br>
        <br>
       
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
							<a href="index.php"><li>Inicio</li></a>
							<!-- <a href="#" onclick="$('#fh5co-features').goTo();return false;"><li>Features</li></a> -->
							<a href="terminosycondiciones" onclick="$('#fh5co-reviews').goTo();return false;"><li>Terminos Y Condiciones</li></a>
							<a href="privacidad" onclick="$('#fh5co-reviews').goTo();return false;"><li>Privacidad</li></a>
							
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
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/owl.carousel.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/main.js"></script>
        </body>
        </html>