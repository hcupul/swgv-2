<?php

include ("../conexion.php");

$idCelular= $_POST['id'];

$sql = "
SELECT 
    u.IdUbicacion AS IdUbicacion,
    u.Latitud, 
    u.Longitud, 
    cel.Numero,
    cel.IdCelular
FROM ubicacioncelular ub
LEFT JOIN ubicacion u ON ub.IdUbicacion = u.IdUbicacion
LEFT JOIN celular cel ON ub.IdCelular = cel.IdCelular
-- LEFT JOIN usuario us ON us.IdCelular = cel.IdCelular
-- LEFT JOIN vehiculo ve ON ve.IdConductor = us.IdUsuario
WHERE ub.IdUbicacion IN (
    SELECT 
        MAX(u.IdUbicacion) AS IdUbicacion
    FROM ubicacioncelular ub
    LEFT JOIN ubicacion u ON ub.IdUbicacion = u.IdUbicacion
    LEFT JOIN celular cel ON ub.IdCelular = cel.IdCelular
    WHERE ub.Estado = 1 AND u.Fecha >= DATE_SUB(NOW(),INTERVAL 1 HOUR) 
    GROUP BY cel.IdCelular
) 
";

if($idCelular != "0") {
    $sql = $sql . "AND ub.IdCelular = $idCelular ";
}

$ubicacion = traerDatos($sql);
$js = json_encode($ubicacion);
echo $js;

?>