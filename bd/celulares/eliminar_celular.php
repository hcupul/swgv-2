<?php

include ("../conexion.php");

$id = $_POST['id'];
$sql = "UPDATE celular SET Estado = '0' WHERE IdCelular = $id";

if (guardarDatos($sql)) {
    echo "¡Correcto! El celular fue eliminado con éxito.";
} else {
    echo "¡Error! No fue posible eliminar el celular.";
}