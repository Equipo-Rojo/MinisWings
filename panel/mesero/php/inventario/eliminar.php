<?php
	$id=$_POST['id'];
	include('../inventario.php');
	$inv=new inventario();
	$inv->eliminarProducto($id);
?>