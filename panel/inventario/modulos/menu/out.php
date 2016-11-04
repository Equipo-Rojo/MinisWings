<?php
session_start();
$id=$_SESSION['id'];
$entrada=$_SESSION['entrada'];
date_default_timezone_set('America/mexico_city'); 
$salida=date('Y-m-d H:i:s');

include('../../php/conexion.php');
$con = new Conexion('datosServer.php');
$con = $con->conectar();  
$sql="UPDATE asistencia SET Fecha_Salida='".$salida."' WHERE id_Emp=".$id." AND Fecha_Entrada='".$entrada."'";
$result = $con->query($sql);

session_destroy();
header('Location: ../../../../');     
?>