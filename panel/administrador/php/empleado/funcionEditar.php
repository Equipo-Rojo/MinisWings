<?php
	$datos = json_decode($_POST['datos']);
	$id = $_POST['id'];
	include('../empleados.php');
	$emp=new empleado();
	$emp->editarEmpleado($datos,$id);
	echo 'modulos/menu/empleados.php';
?>