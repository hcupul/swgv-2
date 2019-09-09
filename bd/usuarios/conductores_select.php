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
    (case when (us.Estado = 1) then 'Activo' else 'Inactivo' end) AS Estado 
from usuario us
left join tipousuario tp on us.IdTipoUsuario = tp.IdTipoUsuario 
where us.Estado = 1 
    -- and us.IdUsuario not in (select IdConductor from vehiculo where Estado = 1);

";

echo <<<HTML
<option value="0">Ninguno</option>
HTML;

$arrayUsuarios = traerDatos($sql);
foreach ($arrayUsuarios as $user) {
    $id = $user['IdUsuario'];
    $nombre = $user['Nombre'];

    echo <<<XD
    <option value="$id">$nombre</option>
XD;
}