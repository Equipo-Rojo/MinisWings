<?php
	$datos = json_decode($_POST['datos']);
	$id = $_POST['id'];
	include('../inventario.php');
	$inv=new inventario();
	$inv->editarInventario($datos,$id);
	echo 'modulos/menu/inventario.php';	
?>