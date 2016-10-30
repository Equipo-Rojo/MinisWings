<?php
	$id=$_POST['id'];
	$roll=$_POST['roll'];
	include('../empleados.php');
	$inv=new empleado();
	$inv->resetEmpleado($id, $roll);
?>