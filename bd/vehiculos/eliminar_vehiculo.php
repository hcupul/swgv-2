<?php

include ("../conexion.php");

$id = $_POST['id'];

$sql = "
UPDATE vehiculo 
SET Estado = 0 
WHERE IdVehiculo = $id";

if (guardarDatos($sql)) {
    echo "¡Correcto! El vehículo fue eliminado con éxito.";
} else {
    echo "¡Error! No fue posible eliminar el vehículo.";
}