<?php

try {
    include ("../conexion.php");

    // Aunque diga idvehiculo es el id del celular
    $tempidcelular = $_POST['idvehiculo'];
    $idcelular = trim($tempidcelular); //elimina espacios que agrega js

    $templatitud = $_POST['latitud'];
    $latitud = trim($templatitud);

    $templongitud = $_POST['longitud'];
    $longitud = trim($templongitud);

    $sql = "call SPD_SET_InsertUbicacion('$idcelular','$latitud','$longitud');";

    if (guardarDatos($sql)) {
	echo "La ubicación fue agregada correctamente";
    } else {
	echo "¡Error! No fue posible agregar la ubicación";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}