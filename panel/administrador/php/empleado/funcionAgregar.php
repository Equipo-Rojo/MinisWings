<?php
	$datos = json_decode($_POST['datos']);
	$campos = json_decode($_POST['campos']);
	include('../empleados.php');
	$inv=new empleado();
	$inv->agregarEmpleado($datos, $campos);
	echo 'modulos/menu/empleados.php';
	
?>