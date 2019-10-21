<?php

include ("../conexion.php");

$sql = "
SELECT
    ve.IdVehiculo,
    IFNULL(ve.NumPlaca,'Ninguna') AS Placa,
    IFNULL((case when ve.IdConductor is null then 'Ninguno' else concat(us.Nombre) end), 'Ninguno') AS Conductor,
    us.Numero
FROM vehiculo ve
LEFT JOIN usuario us ON ve.IdConductor = us.IdUsuario And ve.Estado = 1
WHERE ve.Estado = 1 and ve.IdVehiculo in (
    SELECT IdVehiculo 
    FROM ubicacionvehiculo uv
    LEFT JOIN ubicacion u ON u.IdUbicacion = uv.IdUbicacion AND u.Estado = 1 
    WHERE u.Estado = 1 AND u.Fecha >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
)";

$vehiculos = traerDatos($sql);
$i = 0;
$style = "";

foreach ($vehiculos as $ve) {
    $id = $ve['IdVehiculo'];
    $placa = $ve['Placa'];
    $conductor = $ve['Conductor'];
    $numero = $ve['Numero'];
    $i++;
    if($i == 1){
	$style = "primary";
    }
    
    echo <<<XD
<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-$style o-hidden h-100">
	<div class="card-body">
	    <div class="card-body-icon">
		<i class="fas fa-fw fa-car"></i>
	    </div>
	    <div class="mr-5">Vehículo #$id</div>
	    <div class="mr-5">Tel: $numero</div>
	    <!--div class="mr-5">Conductor: $conductor</div-->
	</div>
	<a class="card-footer text-white clearfix small z-1" onclick="verVehiculo($id, event)" href="#">
	    <span class="float-left">Ver en mapa</span>
	    <span class="float-right">
		<i class="fas fa-angle-right"></i>
	    </span>
	</a>
    </div>
</div>
XD;
    
    if($style == "primary"){
	$style = "warning";
    } else if ($style == "warning"){
	$style = "success";
    } else if ($style == "success"){
	$style = "danger";
    } else if ($style == "danger"){
	$style = "primary";
    }
}

if ($i === 0) {
    echo <<<XD
<div class="alert alert-light" role="alert">
  No hay vehículos activos en la última hora
</div>
XD;
}