<?php

include ("../conexion.php");

$id = $_POST['id'];

$sql = "
SELECT 
    IdVehiculo,
    Marca,
    Modelo,
    NumUnidad,
    NumPlaca,
    NumSerie,
    IFNULL(IdConductor, 0) as IdConductor,
Estado
FROM vehiculo
WHERE IdVehiculo = $id;";

$vehiculo = traerDatos($sql);
$js = json_encode($vehiculo);
echo $js;

?>