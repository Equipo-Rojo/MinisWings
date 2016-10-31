<?php
	$id_Cue = $_POST['id_Cue'];
	$tipo = substr($_POST['tipoID'],0,-2);
	$id = substr($_POST['tipoID'],-1);
	$cantidad = $_POST['cantidad'];
	include('../cuenta.php');
	$inv=new orden();
	$inv->nuevaOdren($id_Cue, $id, $tipo, $cantidad);
?>

