<?php

try {

    include ("../conexion.php");

    $tempid = $_POST['id'];
    $id = trim($tempid);

    $tempmarca = $_POST['marca'];
    $marca = trim($tempmarca); //elimina espacios que agrega js

    $tempmodelo = $_POST['modelo'];
    $modelo = trim($tempmodelo);

    $tempnumunidad = $_POST['numunidad'];
    $numunidad = trim($tempnumunidad);

    $tempnumplaca = $_POST['numplaca'];
    $numplaca = trim($tempnumplaca);

    $tempnumserie = $_POST['numserie'];
    $numserie = trim($tempnumserie);

    $tempidconductor = $_POST['idconductor'];
    $idconductor = trim($tempidconductor);

    $sql = "
UPDATE vehiculo 
SET Marca = '$marca', 
    Modelo = '$modelo', 
    NumUnidad = '$numunidad', 
    NumPlaca = '$numplaca', 
    NumSerie = '$numserie',
    IdConductor = '$idconductor'
WHERE IdVehiculo = '$id';
";

    if ($idconductor == "0") {
	$sql = "
	UPDATE vehiculo 
	SET Marca = '$marca', 
	    Modelo = '$modelo', 
	    NumUnidad = '$numunidad', 
	    NumPlaca = '$numplaca', 
	    NumSerie = '$numserie',
	    IdConductor = null 
	WHERE IdVehiculo = '$id';
	";
    }
    
    if (guardarDatos($sql)) {
	echo "El vehiculo fue actualizado correctamente";
    } else {
	echo "¡Error! No fue posible actualizar los datos del vehiculo";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}