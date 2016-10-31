<?php
	$mesa = $_POST['mesa'];
	$status = $_POST['status'];
	include('../cuenta.php');
	$inv=new orden();
	$inv->nuevaCuenta($mesa, $status);
?>