<?php

try {
    include ("conexion.php");

    $sql = "UPDATE ubicacion SET Fecha = NOW() WHERE IdUbicacion = 9";

    if (guardarDatos($sql)) {
	echo "¡Correcto!";
    } else {
	echo "¡Error!";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}