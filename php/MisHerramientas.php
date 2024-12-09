<?php
// Iniciar la sesión
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Obtener el ID del usuario logeado
    $sql = "SELECT ID FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $IDusuario = $usuario['ID'];

    // Consultar las herramientas del usuario actual
    $sql = "SELECT IDherramienta, nombreherramienta, imagenes FROM herramientas WHERE IDusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $IDusuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $herramientas = $resultado->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conexion->close();
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
	<link rel="stylesheet" href="/css/owl.carousel.css">
	<link rel="stylesheet" href="/css/owl.theme.default.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="/css/animate.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/MisHerramientas.css">
    <!-- <link rel="stylesheet" href="../css/MisArticulos.css"> -->

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

        <br><br>

        <div id="tool-list">
            <?php foreach ($herramientas as $herramienta): ?>
                <div class="tool-card" data-id="<?php echo $herramienta['IDherramienta']; ?>">
                    <div class="tool-image">
                        <img src="<?php echo $herramienta['imagenes']; ?>" alt="Imagen de <?php echo $herramienta['nombreherramienta']; ?>">
                    </div>
                    <div class="tool-name"><?php echo $herramienta['nombreherramienta']; ?></div>
                    <div class="tool-actions">
                    <button class="edit-btn" onclick="window.location.href='EditarHerramienta.php?IDherramienta=<?php echo $herramienta['IDherramienta']; ?>'">Editar</button>

                        <button class="delete-btn" onclick="confirmDelete(<?php echo $herramienta['IDherramienta']; ?>)">Eliminar</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="tool-list">
    <!-- Tus tarjetas de herramientas -->
</div>

<!-- Modal -->
<div class="modal" id="delete-modal" style="display: none;">
    <div class="modal-content">
        <p>¿Seguro que desea eliminar esta herramienta?</p>
        <div class="modal-buttons">
            <button class="yes-btn" onclick="deleteTool()">Sí</button>
            <button class="no-btn" onclick="closeModal()">No</button>
        </div>
    </div>
</div>




        <script>
            let toolToDelete = null;

            function confirmDelete(IDherramienta) {
                toolToDelete = IDherramienta;
                document.getElementById("delete-modal").style.display = "block";
            }

            function closeModal() {
                document.getElementById("delete-modal").style.display = "none";
                toolToDelete = null;
            }

            function deleteTool() {
    if (toolToDelete) {
        fetch("eliminar_herramienta.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "IDherramienta=" + toolToDelete
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Herramienta eliminada correctamente")) {
                document.querySelector(`[data-id='${toolToDelete}']`).remove();
                closeModal();
            } else {
                alert("Error al eliminar la herramienta: " + data);
            }
        })
        .catch(error => alert("Error en la solicitud: " + error));
    }
}

        </script>
    </div>

    <!-- FOOTER -->
		 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
         <footer class="footer-outer">
		<div class="container footer-inner">

			<div class="footer-three-grid wow fadeIn animated" data-wow-delay="0.66s">
				<div class="column-1-3">
					<h1>Prest-AR</h1>
				</div>
				<div class="column-2-3">
					<nav class="footer-nav">
						<ul>
							<li><a href="index.php">Inicio</a></li>
							<li><a href="terminosycondiciones.php" onclick="$('#fh5co-reviews').goTo();return false;">Terminos Y Condiciones</a></li>
							<li><a href="privacidad.php" onclick="$('#fh5co-reviews').goTo();return false;">Privacidad</a></li>
							
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
