<?php
	$id_Cue = $_POST['id_Cue'];
	$id = substr($_POST['tipoID'],-1,1);
	$tipo = substr($_POST['tipoID'],0,-2);
	$comentarios = $_POST['comentarios'];

	$cantidad = $_POST['cantidad'];
	include('../cuenta.php');
	$inv=new orden();
	$inv->nuevaOdren($id_Cue, $id, $tipo, $cantidad, $comentarios);
?>

