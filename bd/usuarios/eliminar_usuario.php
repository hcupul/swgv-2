<?php

include ("../conexion.php");

$id = $_POST['id'];
$sql = "UPDATE usuario set Estado = 0 where IdUsuario = $id";

if (guardarDatos($sql)) {
    echo "¡Correcto! El usuario fue eliminado con éxito.";
} else {
    echo "¡Error! No fue posible eliminar al usuario.";
}