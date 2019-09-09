<?php

include ("../conexion.php");

$sql = "
select 
    v.IdVehiculo AS IdVehiculo,
    v.Marca AS Marca,
    v.Modelo AS Modelo,
    v.NumUnidad AS NumUnidad,
    v.NumSerie AS NumSerie,
    v.NumPlaca AS NumPlaca,
    (case when v.IdConductor is null then 'Ninguno' else concat(us.Nombre,' ',us.ApellidoPat) end) AS Conductor,
    (case when v.Estado = 1 then 'Activo' else 'Inactivo' end) AS Estado 
from vehiculo v 
      left join usuario us on v.IdConductor = us.IdUsuario 
where v.Estado = 1";

$vehiculos = traerDatos($sql);
foreach ($vehiculos as $vehiculo) {
    $id = $vehiculo['IdVehiculo'];
    $marca = $vehiculo['Marca'];
    $modelo = $vehiculo['Modelo'];
    $numunidad = $vehiculo['NumUnidad'];
    $numserie = $vehiculo['NumSerie'];
    $numplaca = $vehiculo['NumPlaca'];
    $conductor = $vehiculo['Conductor'];
    $estado = $vehiculo['Estado'];

    echo <<<XD
	<tr class="odd gradeX">
	    <td>$id</td>
	    <td>$marca</td>
	    <td>$modelo</td>
	    <td>$numunidad</td>
	    <td>$numserie</td>
	    <td>$numplaca</td>
	    <td>$conductor</td>
            <td>
		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
		  <button type="button" class="btn btn-warning" id='editar' onclick='editar($id)' style="color: white;"><i class="fa fa-edit"></i></button>
		  <button type="button" class="btn btn-danger" id='eliminar' onclick='confirmaEliminar($id)'><i class="fa fa-trash"></i></button>
		</div>
	    </td>
        </tr>
XD;
}