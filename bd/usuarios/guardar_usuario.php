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

    $tempnumero = $_POST['numero'];
    $numero = trim($tempnumero);

    $noEmpleado = '0';

    $sql = "
    INSERT INTO usuario 
    (Nombre, ApellidoPat, ApellidoMat, Correo, NoEmpleado, Puesto, Usuario, Password, IdTipoUsuario, Numero)
    VALUES
    ('$nombre','$apepat','$apemat','$correo','$noEmpleado','$puesto','$usuario','$password','$tipousuario','$numero');
    ";
    
    $sql2 = "SELECT Numero FROM usuario WHERE estado = 1 and Numero = '$numero'";
    $arrayTelefonos = traerDatos($sql2);
    $telefonosExistentes = sizeOf($arrayTelefonos);
    
    if($telefonosExistentes > 0){
	echo "El telefono ingresado ya pertenece a otro usuario";
    }
    else if (guardarDatos($sql)) {
	$sqlTelefono = "INSERT INTO celular (Marca, Modelo, Numero, Estado) VALUES ('Desconocido', 'Desconocido', '$numero', '1')";
	guardarDatos($sqlTelefono);
	echo "El usuario fue agregado correctamente";
    }
    else {
	echo "¡Error! No fue posible agregar al usuario";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}