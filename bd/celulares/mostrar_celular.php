<?php

include ("../conexion.php");

$id = $_POST['id'];
$sql = "SELECT * FROM celular WHERE IdCelular = $id";
$arduino = traerDatos($sql);
$js = json_encode($arduino);
echo $js;

?>