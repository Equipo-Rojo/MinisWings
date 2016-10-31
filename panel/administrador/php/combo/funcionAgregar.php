<?php
	$datosCombo = json_decode($_POST['datosCombo']);
	$camposCombo = json_decode($_POST['camposCombo']);
	$datosIngrediente = json_decode($_POST['datosIngrediente']);
	$camposIngrediente = json_decode($_POST['camposIngrediente']);
	include('../Combo.php');
	$inv=new Combo();
	$inv->agregarCombo($datosCombo, $camposCombo,$datosIngrediente, $camposIngrediente);
	
?>