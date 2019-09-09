<?php

include ("../conexion.php");

$sql = "
SELECT
    IdCelular,
    Marca,
    Modelo,
    Numero,
    (case when Estado = 1 then 'Activo' else 'Inactivo' end) AS Estado 
FROM celular 
WHERE Estado = 1
AND Numero in
(SELECT Numero FROM usuario WHERE estado = 1)";

$arduinos = traerDatos($sql);
foreach ($arduinos as $arduino) {
    $id = $arduino['IdCelular'];
    $marca = $arduino['Marca'];
    $modelo = $arduino['Modelo'];
    $numero = $arduino['Numero'];
    $estado = $arduino['Estado'];

    echo <<<XD
	<tr>
	    <td>$id</td>
	    <td>$marca</td>
	    <td>$modelo</td>
	    <td>$numero</td>
	    <td>$estado</td>
            <td>
		<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
		  <button type="button" class="btn btn-warning" id='editar' onclick='editar($id)' style="color: white;"><i class="fa fa-edit"></i></button>
		  <!--button type="button" class="btn btn-danger" id='eliminar' onclick='confirmaEliminar($id)'><i class="fa fa-trash"></i></button-->
		</div>
	    </td>
        </tr>
XD;
}