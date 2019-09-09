<?php

include ("../conexion.php");

$idVehiculo = $_POST['id'];

$sql = "
SELECT 
    u.IdUbicacion AS IdUbicacion,
    u.Latitud, 
    u.Longitud, 
    CONCAT('Vehículo ', ve.IdVehiculo, ' - ', IFNULL(us.Numero, 'Sin teléfono')) as Identificador
FROM ubicacionvehiculo ub
LEFT JOIN ubicacion u ON ub.IdUbicacion = u.IdUbicacion
LEFT JOIN vehiculo ve ON ub.IdVehiculo = ve.IdVehiculo
LEFT JOIN usuario us ON us.IdUsuario = ve.IdConductor
WHERE ub.IdUbicacion IN (
    SELECT 
        MAX(u.IdUbicacion) AS IdUbicacion
    FROM ubicacionvehiculo ub
    LEFT JOIN ubicacion u ON ub.IdUbicacion = u.IdUbicacion
    WHERE ub.Estado = 1 AND u.Fecha >= DATE_SUB(NOW(),INTERVAL 1 HOUR) 
    GROUP BY ub.IdVehiculo
) 
";

if($idVehiculo != "0") {
    $sql = $sql . "AND ub.IdVehiculo = $idVehiculo ";
}

$ubicacion = traerDatos($sql);
$js = json_encode($ubicacion);
echo $js;

?>