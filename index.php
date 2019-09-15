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
	echo '<script type="text/javascript">alert("Usuario o contraseña incorrectos");</script>';
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
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
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
    </body>
</html>