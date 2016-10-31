<?php
	$datosPlatillo = json_decode($_POST['datosPlatillo']);
	$camposPlatillo = json_decode($_POST['camposPlatillo']);
	$datosIngrediente = json_decode($_POST['datosIngrediente']);
	$camposIngrediente = json_decode($_POST['camposIngrediente']);
	include('../platillo.php');
	$inv=new platillo();
	$inv->agregarPlatillo($datosPlatillo, $camposPlatillo,$datosIngrediente, $camposIngrediente);
	
?>