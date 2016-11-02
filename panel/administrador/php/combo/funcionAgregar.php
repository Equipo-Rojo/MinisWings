<?php
	$datosCombo = json_decode($_POST['datosCombo']);
	$camposCombo = json_decode($_POST['camposCombo']);
	$idPlatillo = json_decode($_POST['idPlatillo']);
	$cantPlatillo = json_decode($_POST['cantPlatillo']);
	$url=$_POST['url'];
	include('../Combo.php');
	$inv=new Combo();
	$inv->agregarCombo($datosCombo, $camposCombo,$idPlatillo, $cantPlatillo,$url);
	
?>