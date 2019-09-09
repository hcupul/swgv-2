<?php

try {

    include ("../conexion.php");

    $tempid = $_POST['id'];
    $id = trim($tempid);

    $tempnom = $_POST['nom'];
    $nombre = trim($tempnom);

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
    if (!trim($temppass) == "null") {
	$password = md5(trim($temppass));
    } else {
	$password = "null";
    }

    $temptipousuario = $_POST['tipo'];
    $tipousuario = trim($temptipousuario);

    $tempidcelular = $_POST['idcelular'];
    $idcelular = trim($tempidcelular);

    $noEmpleado = '0';

    $sql = "
    UPDATE usuario 
    SET Nombre = '$nombre', 
	ApellidoPat = '$apepat', 
	ApellidoMat = '$apemat',
	Correo = '$correo',
	NoEmpleado = '$noEmpleado',
	Puesto = '$puesto',
	Usuario = '$usuario',
    ";

    if ($password != "null") {
	$sql .= "Password = '$password', ";
    }
    
    if($idcelular == "0"){
	$sql .= " IdCelular = null, ";
    } else {
	$sql .= " IdCelular = '$idcelular', ";
    }

    $sql .= "IdTipoUsuario = '$tipousuario' WHERE IdUsuario = '$id';";

    if (guardarDatos($sql)) {
	echo "El usuario fue actualizado correctamente";
    } else {
	echo "¡Error! No fue posible actualizar los datos del usuario";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}