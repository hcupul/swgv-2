<?php

function conectarBD() {
    $conexion = mysqli_connect("localhost", "root", "", "sgv");
    //$conexion = mysqli_connect("localhost", "u969154419_gps", "1xc2cnDRSHPK", "u969154419_gps");
    return $conexion;
}

function desconectarBD($conexion) {
    $cerrarConexion = mysqli_close($conexion);
    return $cerrarConexion;
}

function guardarDatos($sql) {
    $conexion = conectarBD();
    mysqli_query($conexion, "set names 'utf8'");
    if (!$resultado = mysqli_query($conexion, $sql)) die();
    desconectarBD($conexion);
    return true;
}

function traerDatos($sql) {
    $conexion = conectarBD();
    mysqli_query($conexion, "set names 'utf8'");
    if (!$resultado = mysqli_query($conexion, $sql)) die();
    $arregloDatos = array();
    $i = 0;
    while ($fila = mysqli_fetch_array($resultado)) {
	$arregloDatos[$i] = $fila;
	$i++;
    }
    desconectarBD($conexion);
    return $arregloDatos;
}
?>