<?php

try {
    include ("../conexion.php");

    $tempnom = $_POST['nom'];
    $nombre = trim($tempnom); //elimina espacios que agrega js

    $tempappat = $_POST['apepat'];
    $apepat = trim($tempappat);

    $tempapmat = $_POST['apemat'];
    $apemat = trim($tempapmat);

    $tempcorreo = $_POST['email'];
    $correo = trim($tempcorreo);

    $temppuesto = $_POST['puesto'];
    $puesto = trim($temppuesto);

    $tempusuario = $_POST['user'];
    $usuario = trim($tempusuario);

    $temppass = $_POST['pass'];
    $password = md5(trim($temppass));

    $temptipousuario = $_POST['tipo'];
    $tipousuario = trim($temptipousuario);

    $tempidcelular = $_POST['idcelular'];
    $idcelular = trim($tempidcelular);

    $noEmpleado = '0';

    $sql = "
    INSERT INTO usuario 
    (Nombre, ApellidoPat, ApellidoMat, Correo, NoEmpleado, Puesto, Usuario, Password, IdTipoUsuario, IdCelular)
    VALUES
    ('$nombre','$apepat','$apemat','$correo','$noEmpleado','$puesto','$usuario','$password','$tipousuario','$idcelular');
    ";

    if ($idcelular == "0") {
	$sql = "
	INSERT INTO usuario 
	(Nombre, ApellidoPat, ApellidoMat, Correo, NoEmpleado, Puesto, Usuario, Password, IdTipoUsuario, IdCelular)
	VALUES
	('$nombre','$apepat','$apemat','$correo','$noEmpleado','$puesto','$usuario','$password','$tipousuario',null);
	";
    }

    if (guardarDatos($sql)) {
	echo "El usuario fue agregado correctamente";
    } else {
	echo "¡Error! No fue posible agregar al usuario";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}