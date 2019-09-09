<?php

include ("../conexion.php");

$id = $_POST['id'];

$sql = "SELECT * FROM celular WHERE estado = 1 and IdCelular not in (select ifnull(IdCelular, 0) from usuario where Estado = 1)";

if($id != "0"){
    $sql .= "union SELECT * FROM celular where estado = 1 and IdCelular in (select ifnull(IdCelular, 0) from usuario where IdUsuario = $id)";
}

    echo <<<HTML
<option value="0">Ninguno</option>
HTML;

$arduinos = traerDatos($sql);
foreach ($arduinos as $arduino) {
    $id = $arduino['IdCelular'];
    $marca = $arduino['Marca'];
    $modelo = $arduino['Modelo'];
    $numero = $arduino['Numero'];

    echo <<<XD
<option value="$id">$marca $modelo [$numero]</option>
XD;
}