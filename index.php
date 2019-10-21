<?php
include ("bd/conexion.php");
//instancia de la clase conexión
session_start();

if (isset($_SESSION["id"])) {
    header("Location: mapa.php");
}

if (!empty($_POST)) {
    $usuario = $_POST['usuario'];
    $password = $_POST['pass'];
    $error = '';
    // encriptamos la contraseña con el algoritmo sha1
    $md5password = md5($password);

    $sql = "SELECT * FROM usuario WHERE Usuario = '$usuario' AND Password = '$md5password' AND Estado = 1;";
    // usamos el método CANTIDAD para saber el num de registros
    $usuarios = traerDatos($sql);
    $total = 0;
    foreach ($usuarios as $user) {
	$_SESSION['nombre'] = $user['Nombre'];
	$_SESSION['id'] = $user['IdUsuario'];
	$total ++;
    }
    if ($total > 0) {
	$_SESSION['id'] = $usuario;
	header("location: mapa.php");
    } else {
	header("location: index.php?login=failed");
    }
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="assets/css/login.css" rel="stylesheet">
	<title>Iniciar sesión | Sistema Web de Geolocalización de Vehículos</title>
	<link rel="icon" href="assets/img/icon-small.png">
    </head>
    <body>
	<div class="container">
	    <div class="card card-container">
		<img id="profile-img" class="profile-img-card" src="assets/img/negro-ver.png" />
		<p style="text-align: center; font-size: 12px;">Sistema Web de Geolocalización de Vehículos</p>
		<form class="form-signin" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
		    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
		    <input type="password" id="pass" name="pass" class="form-control" placeholder="Contraseña" required>
		    <button class="btn btn-lg btn-danger" type="submit">Iniciar sesión</button>
		</form><!-- /form -->
	    </div><!-- /card-container -->
	</div>
	<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="lblModal" aria-hidden="true">
	    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Intente de nuevo</h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">×</span>
			</button>
		    </div>
		    <div class="modal-body" id="dvMensaje">
			Usuario o contraseña incorrectos
		    </div>
		    <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
		    </div>
		</div>
	    </div>
	</div>
    </body>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    if(window.location.search.substr(1) === "login=failed"){
	$('#modalLogin').modal('show');
    }
    </script>
</html>