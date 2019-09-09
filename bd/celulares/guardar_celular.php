<?php
try {
include ("../conexion.php");

$tempmarca = $_POST['marca'];
$marca = trim($tempmarca);//elimina espacios que agrega js

$tempmodelo = $_POST['modelo'];
$modelo = trim($tempmodelo);

$tempnumero = $_POST['numero'];
$numero = trim($tempnumero);

$sql = "
INSERT INTO celular 
(Marca, Modelo, Numero, Estado) 
VALUES 
('$marca', '$modelo', '$numero', '1')";


    if (guardarDatos($sql)) {
	echo "El celular fue agregado correctamente";
    } else {
	echo "¡Error! No fue posible agregar el celular";
    }
} catch (Exception $e) {
    echo '¡Error! ' . $e->getMessage();
}