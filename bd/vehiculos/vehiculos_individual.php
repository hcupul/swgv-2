<?php

include ("../conexion.php");

$idVehiculo = $_POST['id'];

$sql = "
SELECT
    ve.IdVehiculo,
    IFNULL(ve.Marca,'Ninguna') AS Marca,
    IFNULL(ve.Modelo,'Ninguno') AS Modelo,
    IFNULL(ve.NumPlaca,'Ninguna') AS Placa,
    IFNULL((case when ve.IdConductor is null then 'Ninguno' else concat(us.Nombre) end), 'Ninguno') AS Conductor,
    IFNULL(us.Numero, 'Ninguno') as Numero
FROM vehiculo ve
LEFT JOIN usuario us ON ve.IdConductor = us.IdUsuario And ve.Estado = 1
WHERE ve.Estado = 1 and ve.IdVehiculo = $idVehiculo";

$vehiculos = traerDatos($sql);
$i = 0;
$style = "";

foreach ($vehiculos as $ve) {
    $id = $ve['IdVehiculo'];
    $marca = $ve['Marca'];
    $modelo = $ve['Modelo'];
    $placa = $ve['Placa'];
    $conductor = $ve['Conductor'];
    $numero = $ve['Numero'];
    $i++;
    if($i == 1){
	$style = "primary";
    }
    
    echo <<<XD
<div class="form-group">
    <div class="dropdown-divider"></div>
    <label class="font-weight-bold">Conductor</label>
    <p>$conductor</p>
</div>
<div class="form-group">
    <label class="font-weight-bold">Teléfono</label>
    <p>$numero</p>
</div>
<div class="form-group">
    <label class="font-weight-bold">Marca</label>
    <p>$marca</p>
</div>
<div class="form-group">
    <label class="font-weight-bold">Modelo</label>
    <p>$modelo</p>
</div>
<div class="form-group">
    <label class="font-weight-bold">Placa</label>
    <p>$placa</p>
    <div class="dropdown-divider"></div>
</div>
XD;
}

if ($i === 0) {
    echo <<<XD
<div class="form-group">
    <label class="font-weight-bold">Aviso</label>
    <p>No existe información del vehículo</p>
</div>
XD;
}