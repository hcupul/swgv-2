<?php

include ("../conexion.php");

$id = $_POST['id'];

$sql = "
SELECT 
    IdUsuario, 
    Nombre, 
    ApellidoPat, 
    ApellidoMat,
    Correo, 
    NoEmpleado, 
    Puesto, 
    Usuario, 
    Password, 
    IdTipoUsuario, 
    IFNULL(IdCelular, 0) AS IdCelular, 
    Estado 
FROM usuario 
WHERE IdUsuario = $id;";

$usuario = traerDatos($sql);
$js = json_encode($usuario);
echo $js;

?>