<?php

include ("../conexion.php");

$sql = "
    
select 
    us.IdUsuario AS IdUsuario, 
    concat(us.Nombre,' ',us.ApellidoPat,' ',us.ApellidoMat) AS Nombre, 
    us.Correo AS Correo,
    us.Puesto AS Puesto,
    us.Usuario AS Usuario,
    tp.Descripcion AS TipoUsuario, 
    IFNULL(cel.Numero, 'Ninguno') AS Numero,
    (case when (us.Estado = 1) then 'Activo' else 'Inactivo' end) AS Estado 
from usuario us 
	left join tipousuario tp on us.IdTipoUsuario = tp.IdTipoUsuario 
    left join celular cel on cel.IdCelular = us.IdCelular and cel.Estado = 1
where us.Estado = 1 
    -- and us.IdUsuario not in (select IdConductor from vehiculo where Estado = 1);

";

$arrayUsuarios = traerDatos($sql);
foreach ($arrayUsuarios as $user) {
    $id = $user['IdUsuario'];
    $nombre = $user['Nombre'];
    $correo = $user['Correo'];
    $puesto = $user['Puesto'];
    $usuario = $user['Usuario'];
    $tipo = $user['TipoUsuario'];
    $numero = $user['Numero'];
    $estado = $user['Estado'];

    echo <<<XD
	<tr>
	    <td>$nombre</td>
	    <td>$correo</td>
	    <td>$usuario</td>
	    <td>$tipo</td>
	    <td>$numero</td>
	    <td>$estado</td>
            <td>
		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
		  <button type="button" class="btn btn-warning" id='editar' onclick='editar($id)' style="color: white;"><i class="fa fa-edit"></i></button>
		  <button type="button" class="btn btn-danger" id='eliminar' onclick='confirmaEliminar($id)'><i class="fa fa-trash"></i></button>
		</div>
	    </td>
        </tr>
XD;
}