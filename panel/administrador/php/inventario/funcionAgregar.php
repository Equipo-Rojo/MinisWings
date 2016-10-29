<?php
	$datos = json_decode($_POST['datos']);
	$campos = json_decode($_POST['campos']);
	include('../inventario.php');
	$inv=new inventario();
	$inv->agregarInventario($datos, $campos);
	
?>