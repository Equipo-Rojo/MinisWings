<?php
	$datosCombo = json_decode($_POST['datosCombo']);
	$camposCombo = json_decode($_POST['camposCombo']);
	$datosPlatillo = json_decode($_POST['datosPlatillo']);
	$camposPlatillo = json_decode($_POST['camposPlatillo']);
	$url=$_POST['url'];
	include('../Combo.php');
	$inv=new Combo();
	$inv->agregarCombo($datosCombo, $camposCombo,$datosPlatillo, $camposPlatillo,$url);
	
?>