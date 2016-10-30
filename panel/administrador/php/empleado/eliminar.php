<?php
	$id=$_POST['id'];
	include('../empleados.php');
	$inv=new empleado();
	$inv->eliminarEmpleado($id);
?>