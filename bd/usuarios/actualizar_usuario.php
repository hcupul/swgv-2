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

    $tempnumero= $_POST['numero'];
    $numero = trim($tempnumero);

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
	Numero = $numero,
    ";

    if ($password != "null") {
	$sql .= "Password = '$password', ";
    }

    $sql .= "IdTipoUsuario = '$tipousuario' WHERE IdUsuario = '$id';";
    
    $sql2 = "SELECT Numero FROM usuario WHERE estado = 1 and Numero = '$numero' and IdUsuario != '$id'";
    $arrayTelefonos = traerDatos($sql2);
    $telefonosExistentes = sizeOf($arrayTelefonos);

     if($telefonosExistentes > 0){
	echo "El telefono ingresado ya pertenece a otro usuario";
    }
    else if (guardarDatos($sql)) {
	if($telefonosExistentes == 0){
	    $sql3 = "SELECT Numero FROM celular WHERE estado = 1 and Numero = '$numero'";
	    $arrayTelefonosRepetidos = traerDatos($sql3);
	    $telefonosRepetidos = sizeOf($arrayTelefonosRepetidos);
	    if($telefonosRepetidos == 0){
		$sqlTelefono = "INSERT INTO celular (Marca, Modelo, Numero, Estado) VALUES ('Desconocido', 'Desconocido', '$numero', '1')";
		guardarDatos($sqlTelefono);
	    }
	}
	echo "El usuario fue actualizado correctamente";
    } 
    else {
	echo "¡Error! No fue posible actualizar los datos del usuario";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}