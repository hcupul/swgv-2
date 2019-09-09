<?php

try {
    include ("../conexion.php");

    $tempid = $_POST['id'];
    $id = trim($tempid);

    $tempmarca = $_POST['marca'];
    $marca = trim($tempmarca); //elimina espacios que agrega js

    $tempmodelo = $_POST['modelo'];
    $modelo = trim($tempmodelo);

    $tempnumero = $_POST['numero'];
    $numero = trim($tempnumero);

    $sql = "
UPDATE celular 
SET Marca = '$marca', 
	Modelo = '$modelo', 
	Numero = '$numero' 
WHERE IdCelular = $id;";

    if (guardarDatos($sql)) {
	echo "El celular fue actualizado correctamente";
    } else {
	echo "¡Error! No fue posible actualizar los datos del celular";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}