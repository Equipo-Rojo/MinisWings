<?php
	$datos = json_decode($_POST['datos']);
	$id = $_POST['id'];
	include('../contacto.php');
	$inv=new contacto();
	$inv->editarContacto($datos);
	
?>