<?php
	$mesa = $_POST['mesa'];

	include('../cuenta.php');
	$inv=new orden();
	$inv->nuevaCuenta($mesa);
?>