<?php

try {
    include ("../conexion.php");

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
    INSERT INTO vehiculo 
    (Marca, Modelo, NumUnidad, NumPlaca, NumSerie, IdConductor) 
    VALUES 
    ('$marca','$modelo','$numunidad','$numplaca','$numserie','$idconductor');";

    if ($idconductor == "0") {
	$sql = "
	INSERT INTO vehiculo 
	(Marca, Modelo, NumUnidad, NumPlaca, NumSerie, IdConductor) 
	VALUES 
	('$marca','$modelo','$numunidad','$numplaca','$numserie',null);";
    }

    if (guardarDatos($sql)) {
	echo "El vehículo fue agregado correctamente";
    } else {
	echo "¡Error! No fue posible agregar el vehículo";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}